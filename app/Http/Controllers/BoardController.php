<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\{Board, Website, User};
use \Illuminate\Foundation\Validation\ValidatesRequests;

class BoardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $boards = $request->user()->boards()->get();

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
        $websites = Website::where('board_id', $id)->get();

        $board = Board::find($id);
        $board_users = $board->users()->get();

        $allUsers = $this->getUsersOffBoard($board);


        return view('backend.board', [
            'board_id' => $id,
            'websites' => $websites,
            'board_users' => $board_users,
            'allUsers' => $allUsers,
        ]);
    }

    public function getUsersOffBoard($board)
    {
        $usersOffBoard = User::whereNotIn('id', $board->users()->pluck('id'))->get();

        return $usersOffBoard;
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
}