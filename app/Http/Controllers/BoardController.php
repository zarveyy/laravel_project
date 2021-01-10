<?php

namespace App\Http\Controllers;

use App\Models\{Board, User};
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class BoardController extends Controller
{


    /**
     * Create the controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        /*
         * Cette fonction gre directement les autorisations pour chacune des méthodes du contrôleur
         * en fonction des méthode du BoardPolicy (viewAny, view, update, create, ...)
         *
         *  https://laravel.com/docs/8.x/authorization#authorizing-resource-controllers
         */
        $this->authorizeResource(Board::class, 'board');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        // We get all the boards the users is in
        $user = Auth::user();
        return view('user.boards.index', ['boards' => $user->boards]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('user.boards.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
        // $this->authorize('create', Board::class);
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'description' => 'max:4096',
        ]);
        $board = new Board();
        $board->user_id = Auth::user()->id;
        $board->title = $validatedData['title'];
        $board->description = $validatedData['description'];


        $board->save();
        return redirect()->route('boards.index');
    }

    /**
     * Display the specified resource.
     *
     * @param Board $board
     * @return Response
     */
    public function show(Board $board)
    {


        // $this->authorize('view', $board);


        //We needs to list the users not belonging to the board to invite them
        // First, we get the id of all users of the board
        $boardUsersId = $board->users->pluck('id');

        // On sélectionne maintenant tous les utilisateurs dont l'id n'appartient pas à la liste des ids des utilisateurs du board
        // Now we get all the users whose ids are not in the list of the board user id
        $usersNotInBoard = User::whereNotIn('id', $boardUsersId)->get();
        return view("user.boards.show", ["board" => $board, 'users' => $usersNotInBoard]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Board $board
     * @return Response
     */
    public function edit(Board $board)
    {
        //
        return view('user.boards.edit', ['board' => $board]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Board $board
     * @return Response
     */
    public function update(Request $request, Board $board)
    {
        //
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'description' => 'max:4096',
        ]);
        $board->title = $validatedData['title'];
        $board->description = $validatedData['description'];
        $board->update();

        return redirect()->route('boards.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Board $board
     * @return Response
     */
    public function destroy(Board $board)
    {
        //TODO
        $board->delete();
        return redirect()->route('boards.index');
    }
}
