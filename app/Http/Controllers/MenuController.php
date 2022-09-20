<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;
use App\Http\Requests\Menu\CreateRequest;
use App\Http\Requests\Menu\EditRequest;
use App\Http\Controllers\Api\BaseController;
use App\Http\Resources\MenuResource;
use App\Models\Client;

class MenuController extends BaseController
{

    public function __construct()
    {
        $this->authorizeResource(Menu::class, 'menu');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $page_title = 'Menus';

        $menus = Menu::with('creater')->pimp()->paginate();

        if ($request->is('api/*')) {

            $menus = MenuResource::collection($menus);
            return $this->sendResponse(compact('menus'), "All Record");
        }

        return view('menu.index', compact('page_title', 'menus'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $page_title = 'Menus';
        $page_description = 'Create your menu';
        $menus = Menu::all();
        $clients = Client::all();
        return view('menu.create', compact('page_title', 'menus', 'clients'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateRequest $request)
    {
        $menu = Menu::createUpdate(new Menu, $request);

        $message = "Menu added successfully";

        if ($request->is('api/*')) {

            $menu = new MenuResource($menu);
            return $this->sendResponse(compact('menu'), $message);
        }

        return redirect(route('menus.index'))->with('message', $message);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function show(Menu $menu)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function edit(Menu $menu)
    {
        $page_title = 'Menus';
        $menus = Menu::all();
        $clients = Client::all();
        return view('menu.edit', compact('page_title', 'menus', 'menu', 'clients'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function update(EditRequest $request, Menu $menu)
    {
        $menu = Menu::createUpdate($menu, $request);

        $message = "Menu updated successfully";

        if ($request->is('api/*')) {

            $menu = new MenuResource($menu);
            return $this->sendResponse(compact('menu'), $message);
        }

        return redirect(route('menus.index'))->with('message', $message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function destroy(Menu $menu, Request $request)
    {
        $menu->delete();

        $message = "Menu deleted successfully";

        if ($request->is('api/*')) {

            $menu = new MenuResource($menu);
            return $this->sendResponse(compact('menu'), $message);
        }

        return redirect(route('menus.index'))->with('message', $message);
    }
}
