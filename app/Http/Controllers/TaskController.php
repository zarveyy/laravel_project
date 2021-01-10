<?php

namespace App\Http\Controllers;

use App\Models\{Board, Category, Comment, Task, User};
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class TaskController extends Controller
{

    public function __construct()
    {
        /*
         * Cette fonction gre directement les autorisations pour chacune des méthodes du contrôleur
         * en fonction des méthode du BoardPolicy (viewAny, view, update, create, ...)
         *
         *  https://laravel.com/docs/8.x/authorization#authorizing-resource-controllers
         */
        $this->authorizeResource(Task::class, 'task');
    }

    /**
     * Display a listing of the resource.
     *
     * @param Board $board
     * @return Response
     */
    public function index(Board $board)
    {
        // List all tasks belonging to the board
        return view('tasks.index', ['board' => $board]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Board $board le board à partir duquel on crée la tâche
     * @return Response
     */
    public function create(Board $board)
    {
        //List categories of a tasks
        $categories = Category::all();
        return view('tasks.create', ['categories' => $categories, 'board' => $board]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @param Board $board le board pour lequel on crée la tâche
     * @return Response
     */
    public function store(Request $request, Board $board)
    {
        //Check tasks and save it in db
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string|max:4096',
            'due_date' => 'date|after_or_equal:tomorrow',
            'category_id' => 'nullable|integer|exists:categories,id',
        ]);
        $validatedData['board_id'] = $board->id;
        Task::create($validatedData);
        return redirect()->route('tasks.index', [$board]);

    }

    /**
     * Display the specified resource.
     *
     * @param Board $board
     * @param Task $task
     * @return Response
     */
    public function show(Board $board, Task $task)
    {
        //Check if a board user is assigned or not to a task, if not, he's available to be added
        $TaskUserId = $task->assignedUsers->pluck('id');
        $BoardUserId = $board->users->pluck('id');
        $UserNotInTask = User::whereNotIn('id', $TaskUserId)->whereIn('id', $BoardUserId)->get();
        $taskComment = $task->comments->pluck('id');
        $Allcomment = Comment::whereIn('id', $taskComment)->get();

        return view('tasks.show', ['board' => $board, 'task' => $task, 'users' => $UserNotInTask, 'comments' => $Allcomment]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Board $board
     * @param Task $task
     * @return Response
     */
    public function edit(Board $board, Task $task)
    {
        //
        return view('tasks.edit', ['board' => $board, 'task' => $task, 'categories' => Category::all()]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Board $board
     * @param Task $task
     * @return Response
     */
    public function update(Request $request, Board $board, Task $task)
    {
        //
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string|max:4096',
            'due_date' => 'date|after_or_equal:tomorrow',
            'category_id' => 'nullable|integer|exists:categories,id',
            'state' => 'in:todo,ongoing,done'
        ]);
        // TODO :  Il faut vérifier que le board auquel appartient la tâche appartient aussi à l'utilisateur qui fait cet ajout.

        $task->update($validatedData);
        return redirect()->route('tasks.index', [$board]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Board $board
     * @param Task $task
     * @return Response
     */
    public function destroy(Board $board, Task $task)
    {
        $task->delete();
        return redirect()->route('tasks.index', [$board]);
    }
}
