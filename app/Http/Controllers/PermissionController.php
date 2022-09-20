<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Api\BaseController;
use App\Http\Requests\Permission\CreateRequest;
use App\Http\Requests\Permission\EditRequest;
use App\Http\Resources\PermissionResource;
use App\Models\Permission;
use Illuminate\Http\Request;

class PermissionController extends BaseController
{

    public function __construct()
    {
        $this->authorizeResource(Permission::class, 'permission');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $page_title = 'Permissions';

        $permissions = Permission::with('creater')->pimp()->paginate();

        if ($request->is('api/*')) {

            $permissions = PermissionResource::collection($permissions);

            return $this->sendResponse(compact('permissions'), "All Record");
        }

        return view('permission.index',compact('page_title','permissions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $page_title = 'Permission';

        $permissions = Permission::all();

        return view('permission.create',compact('page_title','permissions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateRequest $request)
    {
        $permission = Permission::createUpdate(New Permission, $request);

        $message = "Permission added successfully";

        if ($request->is('api/*')) {

            $permission = new PermissionResource($permission);

            return $this->sendResponse(compact('permission'), $message);
        }

        return redirect(route('permissions.index'))->with('message', $message);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function show(Permission $permission)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function edit(Permission $permission)
    {
        $page_title = 'Permissions';

        $permissions = Permission::all();

        return view('permission.edit',compact('page_title','permission','permissions'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function update(EditRequest $request, Permission $permission)
    {
        $permission = Permission::createUpdate($permission, $request);

        $message = "Permission updated successfully";

        if ($request->is('api/*')) {

            $permission = new PermissionResource($permission);

            return $this->sendResponse(compact('permission'), $message);
        }

        return redirect(route('permissions.index'))->with('message', $message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Permission $permission)
    {
        $permission->delete();

        $message = "Permission deleted successfully";

        if ($request->is('api/*')) {

            $permission = new PermissionResource($permission);
            
            return $this->sendResponse(compact('permission'), $message);
        }

        return redirect(route('permissions.index'))->with('message', $message);
    }
}
