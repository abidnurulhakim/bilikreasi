<?php

namespace App\Http\Controllers;

use App\Models\Idea;
use App\Models\IdeaMedia;
use App\Models\Tag;
use App\Models\User;
use App\Services\IdeaService;
use App\Http\Requests\Idea\StoreRequest;
use App\Http\Requests\Idea\UpdateRequest;
use Illuminate\Http\Request;

class IdeaController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->middleware('auth', ['except' => [
            'index', 'show', 'quickLook'
        ]]);
    }

    public function index()
    {
        return redirect()->route('search.index');
    }

    public function create()
    {
        $this->authorize('create', Idea::class);
        if (!auth()->user()->confirmed) {
            \Session::flash('success', "Tolong cek inbox/spam email Anda untuk konfirmasi akun Anda, agar Anda dapat membuat ide");
            return redirect()->back();
        }
        \View::share('pageTitle', 'Buat Ide Baru');
        $tags = Tag::publish()->get()->map(function($tag) {
            return $tag->name; })->toArray();
        return view('idea.create', compact('tags'));
    }

    public function store(StoreRequest $request)
    {
        $this->authorize('store', Idea::class);
        $request->merge(['user_id' => auth()->user()->id]);
        $idea = Idea::create($request->all());
        if ($idea->id) {
            if ($request->file('media')) {
                foreach ($request->file('media') as $photo) {
                    if ($photo) {
                        IdeaMedia::create(['idea_id' => $idea->id, 'url' => $photo]);
                    }
                }
            }
            \Session::flash('success', 'Ide berhasil dibuat');
            return redirect()->route('idea.show', $idea);
        }
        \Session::flash('alert', 'Ide gagal dibuat');
        return redirect()->back()->withInput();
    }

    public function show($slug)
    {
        $idea = Idea::where('slug', $slug)->firstOrFail();
        \View::share('pageTitle', 'Detil Ide');
        return view('idea.show', compact('idea'));
    }

    public function edit($slug)
    {
        $idea = Idea::where('slug', $slug)->firstOrFail();
        $this->authorize('edit', $idea);
        \View::share('pageTitle', 'Perbaharui Ide');
        $tags = [];
        foreach (Tag::publish()->get() as $tag){
            $tags[$tag->name] = $tag->name;
        }
        return view('idea.edit', compact('idea', 'tags'));
    }

    public function update(UpdateRequest $request, $slug)
    {
        $idea = Idea::where('slug', $slug)->firstOrFail();
        $this->authorize('update', $idea);
        $idea->fill($request->all());
        if ($idea->save()) {
            if ($request->file('media')) {
                foreach ($request->file('media') as $photo) {
                    if ($photo) {
                        IdeaMedia::create(['idea_id' => $idea->id, 'url' => $photo]);
                    }
                }
            }
            \Session::flash('success', 'Ide berhasil diperbaharui');
            return redirect()->route('idea.show', $idea);
        }
        \Session::flash('alert', 'Ide gagal diperbaharui');
        return redirect()->back()->withInput();
    }

    public function destroy($slug)
    {
        $idea = Idea::where('slug', $slug)->firstOrFail();
        $this->authorize('delete', $idea);
        $user = $idea->user;
        $idea->delete();
        \Session::flash('alert', 'Ide telah dihapus');
        return redirect()->route('user.show', $user);
    }

    public function join($slug)
    {
        $idea = Idea::where('slug', $slug)->firstOrFail();
        $member = IdeaService::join($idea, auth()->user());
        if ($member) {
            \Session::flash('success', 'Anda berhasil bergabung dengan ide ' + $idea->title);
            return redirect()->route('idea.show', $idea);
        } else {
            return redirect()->back();
        }
    }

    public function members(Request $request, $slug)
    {
        $idea = Idea::where('slug', $slug)->firstOrFail();
        \View::share('pageTitle', "Anggota '$idea->title'");
        $users = $idea->members()->paginate(12);
        $users->appends($request->all());
        if ($request->ajax()) {
            return view('idea.members-ajax', compact('users', 'idea'));
        }
        return view('idea.members', compact('idea', 'users'));
    }

    public function invitation($slug, $username)
    {
        $idea = Idea::where('slug', $slug)->firstOrFail();
        $user = User::where('username', $username)->firstOrFail();
        $invitation = IdeaService::createInvitation($idea, $user);
        if ($invitation) {
            \Session::flash('success', 'Undangan berhasil dikirim');
        } else {
            \Session::flash('alert', 'Undangan gagal dikirim');
        }
        return redirect()->back();
    }

    public function removeInvitation($slug, $username)
    {
        $idea = Idea::where('slug', $slug)->firstOrFail();
        $user = User::where('username', $username)->firstOrFail();
        $invitation = IdeaService::removeInvitation($idea, $user);
        \Session::flash('alert', 'Undangan telah ditarik kembali');
        return redirect()->back();
    }

    public function like($slug, $username)
    {
        $idea = Idea::where('slug', $slug)->firstOrFail();
        $user = User::where('username', $username)->firstOrFail();
        $like = IdeaService::like($idea, $user);
        if ($like) {
            \Session::flash('success', 'Terima kasih Anda menyukai ide ini');
        } else {
            \Session::flash('alert', 'Menyukai ide gagal dilakukan');
        }
        return redirect()->back();
    }

    public function unlike($slug, $username)
    {
        $idea = Idea::where('slug', $slug)->firstOrFail();
        $user = User::where('username', $username)->firstOrFail();
        $like = IdeaService::unlike($idea, $user);
        \Session::flash('alert', 'Anda tidak jadi menyukai ide ini');
        return redirect()->back();
    }

    public function quickLook($slug)
    {
        $idea = Idea::where('slug', $slug)->firstOrFail();
        return view('idea.quick-look', compact('idea'));
    }
}
