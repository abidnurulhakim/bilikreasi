<?php

namespace App\Http\Controllers;

use App\Models\Discuss;
use App\Models\Message;
use App\Services\DiscussService;
use App\Http\Requests\Discuss\MessageRequest;
use Illuminate\Http\Request;
use Request as RequestNonFacade;

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
            \View::share('pageTitle', 'Ruang diskusi dari \''.str_limit($discuss->idea->title, 30).'\'');
            $messages = $discuss->messages()->last()->paginate(20);
        } else {
            \View::share('pageTitle', 'Tidak ruang diskusi yang tersedia');
            $discuss = null;
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
        \View::share('pageTitle', 'Ruang diskusi dari \''.str_limit($discuss->idea->title, 30).'\'');
        $discusses = $this->getDiscusses();
        $messages = $discuss->messages()->last()->paginate(20);
        return view('discuss.show', compact('discuss', 'discusses', 'messages'));
    }

    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function messages(Request $request, $id)
    {
        $discuss = Discuss::findOrFail($id);
        $messages = $discuss->messages()->where('id', '<', $request->get('last_message_id', $discuss->messages()->last()->first()->id))->last()->paginate(20);
        $result = [];
        $result['status'] = 'ok';
        $result['has_more_page'] = false;
        $result['data'] = [];
        foreach ($messages as $message) {
            $user = $message->user;
            $msg = [
                'id' => $message->id,
                'type' => $message->type,
                'content' => $message->content,
                'user_id' => $user->id,
                'user_name' => $user->name,
                'user_photo' => $user->getPhoto(128),
                'created_at' => $message->created_at->toIso8601String()
            ];
            array_push($result['data'], $msg);
        }
        if ($messages->hasMorePages()) {
            $result['has_next_page'] = true;
        }
        return response()->json($result);
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
            if (RequestNonFacade::ajax()) {
                return response()->json(['status' => 'ok', 'message' => '']);
            }
            return redirect()->route('discuss.show', $discuss);
        }
        return redirect()->back();
    }

    private function getDiscusses($keyword = '')
    {
        $idea_ids = auth()->user()->memberOf->map(function($idea) {
            return $idea->id; })->toArray();
        $discusses = Discuss::search($keyword)->whereIn('idea_id', $idea_ids)
                                ->orderBy('updated_at', 'desc')
                                ->get();
        return $discusses;
    }
}
