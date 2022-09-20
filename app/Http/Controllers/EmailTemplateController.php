<?php

namespace App\Http\Controllers;

use App\Models\EmailTemplate;
use Illuminate\Http\Request;
use App\Http\Requests\EmailTemplate\CreateRequest;
use App\Http\Requests\EmailTemplate\EditRequest;
use App\Http\Resources\EmailTemplateResource;
use App\Http\Controllers\Api\BaseController;
use App\Models\Client;

class EmailTemplateController extends BaseController
{
    
    public function __construct()
    {
        $this->authorizeResource(EmailTemplate::class);
        $this->getMiddleware();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, EmailTemplate $emailTemplate)
    {
        $page_title = 'Email Templates';

        $emailTemplates = $emailTemplate->pimp()->paginate();

        if ($request->is('api/*')) {

            $emailTemplates = EmailTemplateResource::collection($emailTemplates);
            return $this->sendResponse(compact('emailTemplates'), "All Record");
        }

        return view('email_templates.index', compact('page_title', 'emailTemplates'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $page_title = 'Email Templates';
        $page_description = 'Create Email Template';
        $clients = Client::all();
        return view('email_templates.create', compact('page_title', 'clients'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateRequest $request)
    {
        $emailTemplate = EmailTemplate::addUpdate(new EmailTemplate, $request);

        $message = "Email Template added successfully";

        if ($request->is('api/*')) {

            $emailTemplate = new EmailTemplateResource($emailTemplate);
            return $this->sendResponse(compact('emailTemplate'), $message);
        }

        return redirect(route('email_templates.index'))->with('message', $message);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\EmailTemplate  $emailTemplate
     * @return \Illuminate\Http\Response
     */
    public function show(EmailTemplate $emailTemplate)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\EmailTemplate  $emailTemplate
     * @return \Illuminate\Http\Response
     */
    public function edit(EmailTemplate $emailTemplate)
    {
        $page_title = 'Email Templates';
        $clients = Client::all();
        return view('email_templates.edit', compact('page_title', 'emailTemplate', 'clients'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\EmailTemplate  $emailTemplate
     * @return \Illuminate\Http\Response
     */
    public function update(EditRequest $request, EmailTemplate $emailTemplate)
    {
        $emailTemplate = EmailTemplate::addUpdate($emailTemplate, $request);

        $message = "Email Template updated successfully";

        if ($request->is('api/*')) {

            $emailTemplate = new EmailTemplateResource($emailTemplate);
            return $this->sendResponse(compact('emailTemplate'), $message);
        }

        return redirect()->route('email_templates.index')->with('message', $message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\EmailTemplate  $emailTemplate
     * @return \Illuminate\Http\Response
     */
    public function destroy(EmailTemplate $emailTemplate, Request $request)
    {
        $emailTemplate->delete();

        $message = "Email Template deleted successfully";

        if ($request->is('api/*')) {

            $emailTemplate = new EmailTemplateResource($emailTemplate);
            return $this->sendResponse(compact('emailTemplate'), $message);
        }

        return redirect()->route('email_templates.index')->with('message', $message);
    }
}
