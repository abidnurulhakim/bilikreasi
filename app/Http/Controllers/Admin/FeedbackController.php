<?php

namespace App\Http\Controllers\Admin;

use App\Models\Feedback;
use App\Services\FeedbackService;
use App\Http\Requests\Admin\Feedback\ReplyRequest;
use App\Http\Controllers\Admin\AdminController;

class FeedbackController extends AdminController
{
    /**
     * Instantiate a new UserController instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        \View::share('feedbackMenu', true);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $feedbacks = Feedback::all();
        return view('admin.feedback.index', compact('feedbacks'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function reply($id)
    {
        $feedback = Feedback::findOrFail($id);
        $feedback->status = 'read';
        $feedback->save();
        return view('admin.feedback.reply', compact('feedback'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function replyStore(ReplyRequest $request, $id)
    {
        $feedback = Feedback::findOrFail($id);
        FeedbackService::reply($feedback, $request->get('reply_content'));
        return redirect()->route('admin.feedback.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $feedback = Feedback::findOrFail($id);
        $feedback->delete();
        return redirect()->route('admin.feedback.index');
    }
}
