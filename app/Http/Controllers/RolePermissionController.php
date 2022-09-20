<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Api\BaseController;
use App\Http\Requests\RolePermission\CreateRequest;
use App\Http\Requests\RolePermission\EditRequest;
use App\Http\Resources\RolePermissionResource;
use App\Models\Permission;
use App\Models\Role;
use App\Models\RolePermission;
use Illuminate\Http\Request;

class RolePermissionController extends BaseController
{

    public function __construct()
    {
        $this->authorizeResource(RolePermission::class);
        $this->getMiddleware();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $page_title = 'Role Permissions';

        $rolePermissions = RolePermission::with('creater')->pimp()->paginate();

        $message = "All Records"; 

        if ($request->is('api/*')) {
            
            $rolePermissions = RolePermissionResource::collection($rolePermissions);
            
            return $this->sendResponse(compact('page_title', 'rolePermissions'), $message);
        }

        return view('role_permission.index',compact('page_title','rolePermissions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $page_title = 'Role Permission';

        $roles = Role::all();

        $permissions = Permission::all();

        return view('role_permission.create',compact('page_title','roles','permissions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateRequest $request)
    {
        $rolePermission = RolePermission::createUpdate(new RolePermission, $request);

        $message = "Role permission added successfully";

        if( $request->is('api/*')){
            
            $rolePermission = new RolePermissionResource($rolePermission);

            return $this->sendResponse(compact('rolePermission'), $message);
        }

        return redirect(route('role_permissions.index'))->with('message', $message);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\RolePermission  $rolePermission
     * @return \Illuminate\Http\Response
     */
    public function show(RolePermission $rolePermission)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\RolePermission  $rolePermission
     * @return \Illuminate\Http\Response
     */
    public function edit(RolePermission $rolePermission)
    {
        $page_title = 'Role Permission';

        $roles = Role::all();

        $permissions = Permission::all();

        return view('role_permission.edit', compact('page_title', 'rolePermission', 'roles', 'permissions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\RolePermission  $rolePermission
     * @return \Illuminate\Http\Response
     */
    public function update(EditRequest $request, RolePermission $rolePermission)
    {
        $rolePermission = RolePermission::createUpdate($rolePermission, $request);

        $message = "Role permission updated successfully";

        if( $request->is('api/*')){

            $rolePermission = new RolePermissionResource($rolePermission);

            return $this->sendResponse(compact('rolePermission'), $message);
        }

        return redirect(route('role_permissions.index'))->with('message', $message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\RolePermission  $rolePermission
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, RolePermission $rolePermission)
    {
        $rolePermission->delete();

        $message = "Role permission deleted successfully";

        if( $request->is('api/*')){

            $rolePermission = new RolePermissionResource($rolePermission);

            return $this->sendResponse(compact('rolePermission'), $message);
        }

        return redirect(route('role_permissions.index'))->with('message', $message);
    }
}
