<?php

namespace App\Http\Controllers;


use App\Models\{Board, BoardUser};
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class BoardUserController extends Controller
{
    //

    /**
     * Store a newly created resource in storage for a given board (in uri param).
     *
     * @param Request $request
     * @param Board $board le board dans lequel on souhaite ajouter un utilisateur
     * @return Response
     */
    public function store(Request $request, Board $board)
    {
        $validatedData = $request->validate([
            'user_id' => 'required|integer|exists:users,id'
        ]);
        $board_user = new BoardUser();
        $board_user->user_id = $validatedData['user_id'];
        $board_user->board_id = $board->id;
        $board_user->save();
        return redirect()->route('boards.show', $board);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param BoardUser $boardUser l'instance à supprimer
     * @return Response
     */
    public function destroy(BoardUser $boardUser)
    {
        //TODO
        $board = $boardUser->boardUser;
        $boardUser->delete();
        return redirect()->route('boards.show', $board);
    }

}
