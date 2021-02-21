<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use KubAT\PhpSimple\HtmlDomParser;
use App\{Board, Website, News, User};
use \Illuminate\Foundation\Validation\ValidatesRequests;


class NewsController extends Controller
{
    public function saveNews($news, $website_id)
    {
        News::create([
            'content' => $news,
            'status' => 'unread',
            'website_id' => $website_id,
            'created_at' => new \DateTime(),
        ]);
    }

    public function getBoardNews($id)
    {
        $board = Board::find($id);
        $board->updated_at = new \DateTime();
        $board->save();

        $websites = Website::where('board_id', $id)->get();

        foreach ($websites as $website) {
            $savedNews = News::where('website_id', $website->id)->pluck('content')->toArray();

            $news = $this->downloadNews($website->url, $website->selector);
            $outputNews = array_map(function ($item) {
                return strip_tags($item);
            }, $news);

            $differenceNews = array_reverse(array_diff($outputNews, $savedNews));

            foreach ($differenceNews as $new) {
                $this->saveNews($new, $website->id);
            }
        }
        return redirect()->route('showBoardNews', ['id' => $id]);
    }



    public function showBoardNews($id)
    {
        $websites = Website::where('board_id', $id)->get();

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

        $sortByunredNews = $this->sortNews($newsArray);
        array_multisort($sortByunredNews, SORT_DESC, $newsArray);


        return view('backend.news', ['board_id' => $id, 'websites' => $newsArray]);
    }




    public function sortNews($news)
    {
        $unredNews = array();
        foreach ($news as $key => $row) {
            $unredNews[$key] = $row['unread'];
        }
        return $unredNews;
    }


    public function downloadNews($url, $element)
    {
        $news = HtmlDomParser::file_get_html($url)->find($element);

        $unique_news = array_unique($news);
        return $unique_news;
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



    public function news()
    {

        $webs = [
            ['https://nil.org.pl/aktualnosci', 'h3'],
            ['https://izba-lekarska.pl/category/monitor-lekarski/', 'h4'],
            ['http://www.oil-tarnow.pl/aktualnosci/grupa/1.html', 'h3.aktualnosc_tytul'],

        ];

        $headers = [];

        foreach ($webs as $web) {
            $header = $this->showHeaders($web[0], $web[1]);
            $headers = array_merge($headers, $header);
        }


        return view('backend.index', ['headers' => $headers]);
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