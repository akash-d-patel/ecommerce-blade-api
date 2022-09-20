<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use DB;
use App\Http\Requests\User\CreateRequest;
use App\Http\Requests\User\EditRequest;
use App\Http\Resources\UserResource;
use App\Http\Controllers\Api\BaseController;
use App\Models\Client;

class UserController extends BaseController
{

    public function __construct()
    {
        $this->authorizeResource(User::class, 'user');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $page_title = 'Users';

        $message = "User listed successfully";

        $users = User::with(['creater'])->pimp()->paginate();

        if ($request->is('api/*')) {
            $users = UserResource::collection($users);
            return $this->sendResponse(compact('page_title', 'users'), $message);
        }

        return view('users.index', compact('page_title', 'users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $page_title = 'Users';

        $clients = Client::all();

        return view('users.create', compact('page_title', 'clients'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateRequest $request)
    {
        $validated = $request->validate([
            'client_id' => 'required',
            'name' => 'required|min:3|max:50',
            'email' => 'email',
            'password' => 'min:6|required_with:password_confirmation|same:password_confirmation',
            'password_confirmation' => 'min:6'
        ]);

        $user = User::createUpdate(new User, $request);

        $message = "User added successfully";

        if ($request->is('api/*')) {

            $user = new UserResource($user);
            return $this->sendResponse(compact('user'), $message);
        }

        return redirect(route('users.index'))->with('message', $message);;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $page_title = 'users';
        $clients = Client::all();
        return view('users.edit', compact('page_title', 'user', 'clients'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(EditRequest $request, User $user)
    {
        $user = User::createUpdate($user, $request);

        $message = "User updated successfully";

        if ($request->is('api/*')) {
            $user = new UserResource($user);
            return $this->sendResponse(compact('user'), $message);
        }

        return redirect(route('users.index'))->with('message', $message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user, Request $request)
    {
        $user->delete();

        $message = "User deleted successfully";

        if ($request->is('api/*')) {
            $user = new UserResource($user);
            return $this->sendResponse(compact('user'), $message);
        }

        return redirect()->route('users.index')->with('message', $message);
    }
}
