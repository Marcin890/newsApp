<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\{Board, Website, User};
use \Illuminate\Foundation\Validation\ValidatesRequests;
use App\Monitor\Repositories\BoardRepository;

class BoardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(BoardRepository $boardRepository)
    {
        $this->bR = $boardRepository;
    }

    public function index(Request $request)
    {
        $boards = $request->user()->boards()->get();

        // $unreaded_news = $this->bR->countUnreadedBordNews($boards);


        return view('backend.index', ['boards' => $boards]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->validate($request, [
            'name' => "required|string",
        ]);

        $board = new Board;
        $board->name = $request->input('name');
        $board->created_at = new \DateTime();
        $board->save();

        $user = $request->user();
        $board->users()->attach($user);

        return redirect()->back();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $board = Board::find($id);
        $websites = $board->websites()->get();
        $board_users = $board->users()->get();

        // $webiste_unreaded = $this->bR->countUnreadedWebsiteNews($websites);

        return view('backend.board', [
            'board_id' => $id,
            'websites' => $websites,
            'board_users' => $board_users,
        ]);
    }

    public function showUsersOffBoard($id)
    {
        $board = Board::find($id);
        $allUsers = $this->bR->getUsersOffBoard($board);

        return view('backend.addUsertoBoard', [
            'allUsers' => $allUsers,
            'board_id' => $id
        ]);
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $board = Board::find($id);
        $board->delete();
        return redirect()->back();
    }

    public function addUserToBoard(Request $request)
    {
        $user_id = $request->input('user_id');
        $board_id = $request->input('board_id');

        $user = User::find($user_id);
        $board = Board::find($board_id);

        $board->users()->attach($user);
        return redirect()->back();
    }

    public function removeUserFromBoard(Request $request)
    {
        $user_id = $request->input('user_id');
        $board_id = $request->input('board_id');

        $user = User::find($user_id);
        $board = Board::find($board_id);

        $board->users()->detach($user);
        return redirect()->back();
    }
}