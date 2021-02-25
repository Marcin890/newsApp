<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use KubAT\PhpSimple\HtmlDomParser;
use App\{Board, Website, News, User};
use \Illuminate\Foundation\Validation\ValidatesRequests;
use App\Monitor\Repositories\NewsRepository;

class NewsController extends Controller
{
    public function __construct(NewsRepository $newsRepository)
    {
        $this->nR = $newsRepository;
    }

    public function refreshAllBoardNews(Request $request)
    {

        $user = $request->user();
        $boards = $user->boards()->get();

        foreach ($boards as $board) {
            $this->getBoardNews($board->id);
        }

        return redirect()->back();
    }


    public function getBoardNews($id)
    {
        $board = Board::find($id);
        $board->updated_at = new \DateTime();
        $board->save();

        $websites = $board->websites()->get();

        foreach ($websites as $website) {
            $savedNews = News::where('website_id', $website->id)->pluck('content')->toArray();

            $news = $this->nR->downloadNews($website->url, $website->selector);
            $outputNews = array_map(function ($item) {
                return strip_tags($item);
            }, $news);

            $differenceNews = array_reverse(array_diff($outputNews, $savedNews));

            foreach ($differenceNews as $new) {
                $this->nR->saveNews($new, $website->id);
            }
        }
    }

    public function refreshBoardNews($id)
    {
        $this->getBoardNews($id);
        return redirect()->route('showBoardNews', ['id' => $id]);
    }

    public function showBoardNews($id)
    {
        $board = Board::find($id);
        $websites = $board->websites()->get();

        $newsArray = [];
        foreach ($websites as $website) {

            $currentNews = News::with('user')->where('website_id', $website->id)->get();

            $unread = News::where([
                ['website_id', $website->id],
                ['status', 'unread']
            ])->count();


            $websiteArray = $website;
            $websiteArray->news = $currentNews->reverse();
            $websiteArray->unread = $unread;

            $newsArray = array_merge($newsArray, array($websiteArray));
        }

        $sortByunredNews = $this->nR->sortNewsByUnreaded($newsArray);
        array_multisort($sortByunredNews, SORT_DESC, $newsArray);



        return view('backend.news', ['board_id' => $id, 'websites' => $newsArray, 'updated' => $board->updated_at]);
    }

    public function readNews($id, Request $request)
    {

        $news = News::find($id);
        $news->status = 'read';
        $news->user_id = $request->user()->id;
        $news->updated_at = new \DateTime();
        $news->save();

        return redirect()->back();
    }

    public function articleNews($id, Request $request)
    {

        $news = News::find($id);
        $news->status = 'article';
        $news->user_id = $request->user()->id;
        $news->updated_at = new \DateTime();
        $news->save();

        return redirect()->back();
    }

    public function showUserArticles(Request $request)
    {
        $user_id = $request->user()->id;

        $user_articles = News::where([
            ['user_id', $user_id],
            ['status', 'article']
        ])->get()->sortByDesc('updated_at');

        return view('backend.article', ['articles' => $user_articles]);
    }
}