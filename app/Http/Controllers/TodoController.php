<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;
use App\Http\Requests\Todo\CreateRequest;
use App\Http\Requests\Todo\EditRequest;
use App\Http\Controllers\Api\BaseController;
use App\Http\Resources\TodoResource;
use App\Models\Client;

class TodoController extends BaseController
{

    public function __construct()
    {
        $this->authorizeResource(Todo::class, 'todo');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $page_title = 'Todo';

        $todos = Todo::with('creater')->pimp()->paginate();

        if ($request->is('api/*')) {

            $todos = TodoResource::collection($todos);
            return $this->sendResponse(compact('todos'), "All Record");
        }

        return view('todo.index', compact('page_title', 'todos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $page_title = 'todos';
        $page_description = 'Create your todo';
        $todos = Todo::all();
        $clients = Client::all();
        return view('todo.create', compact('page_title', 'todos', 'clients'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateRequest $request)
    {
        $todo = Todo::createUpdate(new Todo, $request);

        $message = "Todo added successfully";

        if ($request->is('api/*')) {

            $todo = new TodoResource($todo);
            return $this->sendResponse(compact('todo'), $message);
        }

        return redirect(route('todos.index'))->with('message', $message);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function show(Todo $todo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function edit(Todo $todo)
    {
        $page_title = 'Todo';
        $todos = Todo::all();
        $clients = Client::all();
        return view('todo.edit', compact('page_title', 'todos', 'todo', 'clients'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function update(EditRequest $request, Todo $todo)
    {
        $todo = Todo::createUpdate($todo, $request);

        $message = "Todo updated successfully";

        if ($request->is('api/*')) {

            $todo = new TodoResource($todo);
            return $this->sendResponse(compact('todo'), $message);
        }

        return redirect(route('todos.index'))->with('message', $message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Todo $todo, Request $request)
    {
        $todo->delete();

        $message = "Todo deleted successfully";

        if ($request->is('api/*')) {

            $todo = new TodoResource($todo);
            return $this->sendResponse(compact('todo'), $message);
        }

        return redirect(route('todos.index'))->with('message', $message);
    }
}
