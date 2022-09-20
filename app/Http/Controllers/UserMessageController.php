<?php

namespace App\Http\Controllers;

use App\Models\UserMessage;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Message;
use App\Http\Requests\Message\CreateRequest;
use App\Http\Requests\Message\EditRequest;
use App\Http\Resources\UserMessageResource;
use App\Http\Controllers\Api\BaseController;
use App\Models\Client;

class UserMessageController extends BaseController
{

    public function __construct()
    {
        $this->authorizeResource(UserMessage::class, 'userMessage');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(UserMessage $userMessage, Message $message, Request $request)
    {
        $page_title = 'User Messages';

        $userMessages = $userMessage->pimp()->paginate();

        if ($request->is('api/*')) {
            $userMessages = UserMessageResource::collection($userMessages);
            return $this->sendResponse(compact('userMessages'), "All Record");
        }

        return view('userMessages.index', compact('page_title', 'userMessages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $page_title = 'User Messages';
        $clients = Client::all();
        $receivers = User::where('id', '!=', Auth::user()->id)->get();
        return view('userMessages.create', compact('page_title', 'receivers', 'clients'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateRequest $request)
    {
        $userMessage = UserMessage::addUpdate(new UserMessage, $request);

        $message = "Messages added successfully";

        if ($request->is('api/*')) {
            $userMessage = new UserMessageResource($userMessage);
            return $this->sendResponse(compact('userMessage'), $message);
        }

        return redirect(route('userMessages.index'))->with('message', $message);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\UserMessage  $userMessage
     * @return \Illuminate\Http\Response
     */
    public function show(UserMessage $userMessage)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\UserMessage  $userMessage
     * @return \Illuminate\Http\Response
     */
    public function edit(UserMessage $userMessage)
    {
        $page_title = 'User Messages';
        $clients = Client::all();
        $receivers = User::where('id', '!=', Auth::user()->id)->get();
        return view('userMessages.edit', compact('page_title', 'receivers', 'userMessage', 'clients'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\UserMessage  $userMessage
     * @return \Illuminate\Http\Response
     */
    public function update(UserMessage $userMessage, EditRequest $request)
    {
        $userMessage = UserMessage::addUpdate($userMessage, $request);

        $message = "Messages updated successfully";

        if ($request->is('api/*')) {
            $userMessage = new UserMessageResource($userMessage);
            return $this->sendResponse(compact('userMessage'), $message);
        }
        return redirect()->route('userMessages.index')->with('message', $message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UserMessage  $userMessage
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserMessage $userMessage, Request $request)
    {
        $userMessage->message->delete();

        $message = "Message deleted successfully";

        if ($request->is('api/*')) {
            $userMessage = new UserMessageResource($userMessage);
            return $this->sendResponse(compact('userMessage'), $message);
        }
        return redirect()->route('userMessages.index')->with('message', $message);
    }
}
