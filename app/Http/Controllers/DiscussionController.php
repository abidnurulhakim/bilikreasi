<?php

namespace App\Http\Controllers;

use App\Models\Discussion;
use App\Models\DiscussionParticipant;
use App\Models\Message;
use App\Services\DiscussionService;
use App\Http\Requests\Discussion\MessageRequest;
use Illuminate\Http\Request;
use Request as RequestNonFacade;

class DiscussionController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $discussions = $this->getDiscussions($request->get('name', ''), 10);
        if ($discussions->count() > 0) {
            $discussion = $discussions->first();
            DiscussionService::markAsRead($discussion, auth()->user());
            $messages = $discussion->messages()->last()->paginate(20);
        } else {
            $discussion = null;
            $messages = collect();
        }
        
        return view('discussion.show', compact('discussion', 'discussions', 'messages'));
    }

    public function show($id)
    {
        $discussion = Discussion::findOrFail($id);
        $discussions = $this->getDiscussions();
        DiscussionService::markAsRead($discussion, auth()->user());
        $messages = $discussion->messages()->last()->paginate(20);
        return view('discussion.show', compact('discussion', 'discussions', 'messages'));
    }

    public function readMessages(Request $request, $id)
    {
        $discussion = Discussion::findOrFail($id);
        $messages = $discussion->messages()->where('id', '<', $request->get('last_message_id', $discussion->messages()->last()->first()->id))->last()->paginate(20);
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
                'user_link' => route('user.show', $user),
                'created_at' => $message->created_at->toIso8601String()
            ];
            array_push($result['data'], $msg);
        }
        if ($messages->hasMorePages()) {
            $result['has_more_page'] = true;
        }
        return response()->json($result);
    }

    public function unreadMessages($id)
    {
        $discussion = Discussion::findOrFail($id);
        $messages = DiscussionService::getUnreadMessages($discussion, auth()->user());
        $result = [];
        $result['status'] = 'ok';
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
                'user_link' => route('user.show', $user),
                'created_at' => $message->created_at->toIso8601String()
            ];
            array_push($result['data'], $msg);
        }
        return response()->json($result);
    }

    public function sendMessage(MessageRequest $request, $id)
    {
        $discussion = Discussion::findOrFail($id);
        $message = DiscussionService::sendMessage($discussion, auth()->user(), $request->get('content'));
        if ($message) {
            if (RequestNonFacade::ajax()) {
                return response()->json([
                    'status' => 'ok',
                    'message_id' => $message->id,
                    'message_id_dump' => $request->get('message_id_dump', -1)
                ]);
            }
            return redirect()->route('discussion.show', $discussion);
        }
        return redirect()->back();
    }

    public function markAsRead($id)
    {
        $discussion = Discussion::findOrFail($id);
        DiscussionService::sendMessage($discussion, auth()->user());
        return response()->json([
                    'status' => 'ok',
                ]);
    }

    private function getDiscussions($keyword = '', $limit = 1000)
    {
        $discussion_ids = DiscussionParticipant::whereUserId(auth()->user()->id)
                            ->get()->map(function($participant) {
                                return $participant->discussion_id; 
                            })->toArray();
        $discussions = Discussion::search($keyword)->whereIn('id', $discussion_ids)
                            ->orderBy('updated_at', 'desc')->take($limit)->get();
        return $discussions;
    }
}
