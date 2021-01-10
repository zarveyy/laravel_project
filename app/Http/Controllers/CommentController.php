<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Auth;
use App\Models\Board;
use App\Models\Comment;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //TODO
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //TODO
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request, Task $task, User $user)
    {

        //check the comments and save it in db
        $validatedData = $request->validate([
            'commentaire' => 'required|max:255',
        ]);

        $comment = new Comment();
        $comment->user_id = $user->id;
        $comment->task_id = $task->id;
        $comment->text = $validatedData['commentaire'];
        $comment->save();

        return redirect()->route('boards.index');

    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function show(Comment $comment, Board $board, Task $task)
    {

        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Response
     */
    public function destroy(Comment $comment)
    {
        $this->authorize('destroy', $comment);
        $comment->delete();
        return redirect()->route('boards.index');
    }
}
