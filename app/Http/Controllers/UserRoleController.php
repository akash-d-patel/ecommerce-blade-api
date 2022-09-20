<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Api\BaseController;
use App\Http\Requests\UserRole\CreateRequest;
use App\Http\Requests\UserRole\EditRequest;
use App\Http\Resources\UserRoleResource;
use App\Models\Role;
use App\Models\User;
use App\Models\UserRole;
use Illuminate\Http\Request;

class UserRoleController extends BaseController
{

    public function __construct()
    {
        $this->authorizeResource(UserRole::class);
        $this->getMiddleware();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $page_title = 'User Role';

        $userRoles = UserRole::with('creater')->pimp()->paginate();

        $message = "All Records"; 

        if ($request->is('api/*')) {
            
            $userRoles = UserRoleResource::collection($userRoles);
            
            return $this->sendResponse(compact('page_title', 'userRoles'), $message);
        }

        return view('user_role.index',compact('page_title','userRoles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $page_title = 'User Role';

        $page_description = 'Create User Role';

        $users = User::all();

        $roles = Role::all();

        return view('user_role.create', compact('page_title', 'users','roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateRequest $request)
    {
        
        $userRole = UserRole::createUpdate(new UserRole, $request);

        $message = "User role added successfully";

        if( $request->is('api/*')){
            
            $userRole = new UserRoleResource($userRole);

            return $this->sendResponse(compact('userRole'), $message);
        }

        return redirect(route('user_roles.index'))->with('message', $message);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\UserRole  $userRole
     * @return \Illuminate\Http\Response
     */
    public function show(UserRole $userRole)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\UserRole  $userRole
     * @return \Illuminate\Http\Response
     */
    public function edit(UserRole $userRole)
    {
        $page_title = 'User Role';

        $users = User::all();

        $roles = Role::all();

        return view('user_role.edit', compact('page_title', 'userRole', 'users', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\UserRole  $userRole
     * @return \Illuminate\Http\Response
     */
    public function update(EditRequest $request, UserRole $userRole)
    {
        $userRole = UserRole::createUpdate($userRole, $request);

        $message = "User role updated successfully";

        if( $request->is('api/*')){

            $userRole = new UserRoleResource($userRole);

            return $this->sendResponse(compact('userRole'), $message);
        }

        return redirect(route('user_roles.index'))->with('message', $message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UserRole  $userRole
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, UserRole $userRole)
    {
        $userRole->delete();

        $message = "User role deleted successfully";

        if( $request->is('api/*')){

            $userRole = new UserRoleResource($userRole);

            return $this->sendResponse(compact('userRole'), $message);
        }

        return redirect(route('user_roles.index'))->with('message', $message);
    }
}
