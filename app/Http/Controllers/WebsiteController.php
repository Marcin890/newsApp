<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\{Website};
use \Illuminate\Foundation\Validation\ValidatesRequests;
use App\Monitor\Repositories\NewsRepository;


class WebsiteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(NewsRepository $newsRepository)
    {
        $this->nR = $newsRepository;
    }
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        if ($request->has('save')) {
            $this->validate($request, [
                'name' => "required|string",
                'url' => "required|url",
                'name' => "required|string",
            ]);

            Website::create([
                'name' => $request->input('name'),
                'url' => $request->input('url'),
                'selector' => $request->input('selector'),
                'board_id' => $request->input('board_id'),
                'created_at' => new \DateTime(),
            ]);

            return redirect()->route('showBoard', ['id' => $request->input('board_id')]);
        }
        if ($request->has('test')) {
            $news = $this->nR->downloadNews($request->input('url'),  $request->input('selector'));

            $outputNews = array_map(function ($item) {
                return strip_tags($item);
            }, $news);


            $website = $request->all();

            return view('backend.addWebsite', ['news' => $outputNews, 'board_id' => $request->input('board_id'), 'website' => $website]);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $website = Website::find($id);

        return view('backend.editWebsite', ['website' => $website]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $website = Website::find($request->input('website_id'));

        $website->name = $request->input('name');
        $website->url = $request->input('url');
        $website->selector = $request->input('selector');
        $website->save();

        // $board = $website->board()->pluck('id');

        // dd($board[0]);

        return redirect()->route('boardIndex');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $website = Website::find($id);

        $website->delete();
        return redirect()->back();
    }

    public function addWebsite($board_id)
    {

        return view('backend.addWebsite', ['board_id' => $board_id]);
    }
}