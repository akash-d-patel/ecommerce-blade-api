<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;
use App\Http\Requests\Message\CreateRequest;
use App\Http\Requests\Message\EditRequest;
use App\Http\Resources\MessageResource;
use App\Http\Controllers\Api\BaseController;

class MessageController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Message $message)
    {
        $page_title = 'Message';
        $message =  $message->orderBy('created_at', 'desc');
        $messages = $message->paginate();

        if( $request->is('api/*')){
            $messages = MessageResource::collection($messages);
            return $this->sendResponse(compact('messages'),"All Record");
        }
        return view('messages.index',compact('page_title', 'messages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $page_title = 'Message';
        $page_description = 'Create message';
        return view('messages.create', compact('page_title'));
       
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateRequest $request)
    {
        $message = Message::addUpdate(new Message, $request);

        $message = "Message added successfully";

        if( $request->is('api/*')){
            
            $message = new MessageResource($message);
            return $this->sendResponse(compact('message'),$message);
        }

        return redirect(route('messages.index'))->with('message', 'Message added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function show(Message $message)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function edit(Message $message)
    {
        $page_title = 'Message';
        return view('messages.edit', compact('page_title', 'message'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function update(EditRequest $request, Message $message)
    {
        $message = Message::addUpdate($message, $request);
        return redirect()->route('messages.index')->with('message', 'Message updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function destroy(Message $message)
    {
        $message->delete();
        return redirect()->route('messages.index')->with('message', 'Message deleted successfully');
    }
}
