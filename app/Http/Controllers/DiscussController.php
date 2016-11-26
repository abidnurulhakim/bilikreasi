<?php

namespace App\Http\Controllers;

use App\Models\Discuss;
use App\Models\Message;
use App\Services\DiscussService;
use App\Http\Requests\Discuss\MessageRequest;
use Illuminate\Http\Request;

class DiscussController extends Controller
{
    
    /**
     * Instantiate a new UserController instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $discusses = $this->getDiscusses($request->get('name', ''));
        if ($discusses->count() > 0) {
            $discuss = $discusses->first();
            \View::share('pageTitle', 'Ruang diskusi dari '.str_limit($discuss->idea->title, 30));
            $messages = $discuss->messages;
        } else {
            \View::share('pageTitle', 'Tidak ruang diskusi yang tersedia');
            $discuss = $discusses->first();
            $messages = collect();
        }
        
        return view('discuss.show', compact('discuss', 'discusses', 'messages'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $discuss = Discuss::findOrFail($id);
        \View::share('pageTitle', 'Ruang Diskusi dari '.str_limit($discuss->idea->title,30));
        $discusses = $this->getDiscusses();
        $messages = $discuss->messages;
        return view('discuss.show', compact('discuss', 'discusses', 'messages'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function sendMessage(MessageRequest $request, $id)
    {
        $discuss = Discuss::findOrFail($id);
        $message = DiscussService::sendMessage($discuss, auth()->user(), $request->get('content'));
        if ($message) {
            return redirect()->route('discuss.show', $discuss);
        }
        return redirect()->back();
    }

    private function getDiscusses($keyword = '')
    {
        $idea_ids = auth()->user()->ideas->map(function($idea) {
            return $idea->id; })->toArray();
        $discusses = Discuss::search($keyword)->whereIn('idea_id', $idea_ids)
                                ->orderBy('updated_at', 'desc')
                                ->get();
        return $discusses;
    }
}
