<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Api\BaseController;
use App\Models\Role;
use Illuminate\Http\Request;
use App\Http\Requests\Role\CreateRequest;
use App\Http\Requests\Role\EditRequest;
use App\Http\Resources\RoleResource;

class RoleController extends BaseController
{

    public function __construct()
    {
        $this->authorizeResource(Role::class, 'role');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $page_title = 'Roles';

        $roles = Role::with('creater')->pimp()->paginate();

        if ($request->is('api/*')) {

            $roles = RoleResource::collection($roles);
            return $this->sendResponse(compact('roles'), "All Record");
        }

        return view('role.index', compact('page_title','roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $page_title = 'Roles';

        $roles = Role::all();

        return view('role.create', compact('page_title','roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateRequest $request)
    {
        $role = Role::createUpdate(New Role, $request);

        $message = "Role added successfully";

        if ($request->is('api/*')) {

            $role = new RoleResource($role);
            return $this->sendResponse(compact('role'), $message);
        }

        return redirect(route('roles.index'))->with('message', $message);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        $page_title = 'Roles';

        $roles = Role::all();

        return view('role.edit', compact('page_title','roles','role'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(EditRequest $request, Role $role)
    {
        $role = Role::createUpdate($role, $request);

        $message = "Role updated successfully";

        if ($request->is('api/*')) {

            $role = new RoleResource($role);
            return $this->sendResponse(compact('role'), $message);
        }

        return redirect(route('roles.index'))->with('message', $message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role, Request $request)
    {
        $role->delete();

        $message = "Role deleted successfully";

        if ($request->is('api/*')) {

            $role = new RoleResource($role);
            return $this->sendResponse(compact('role'), $message);
        }

        return redirect(route('roles.index'))->with('message', $message);
    }
}
