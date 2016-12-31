<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use App\Models\FeedbackAttachment;
use App\Http\Requests\Feedback\StoreRequest;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        $feedback = Feedback::create($request->all());
        if ($feedback->id) {
            if ($request->file('attachments')) {
                foreach ($request->file('attachments') as $attachment) {
                    if ($attachment) {
                        FeedbackAttachment::create([
                        		'feedback_id' => $feedback->id,
                        		'url' => $attachment
                        	]);
                    }
                }
            }
            \Session::flash('success', 'Terima kasih atas feedback Anda');
        } else {
        	\Session::flash('alert', 'Maaf kritik dan saran Anda gagal disimpan');
        }
        return redirect()->back();
    }
}
