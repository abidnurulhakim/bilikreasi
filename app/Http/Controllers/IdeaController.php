<?php

namespace App\Http\Controllers;

use App\Models\Idea;
use App\Models\IdeaPhoto;
use App\Models\IdeaTag;
use App\Models\Tag;
use App\Http\Requests\Idea\StoreRequest;
use App\Http\Requests\Idea\UpdateRequest;
use Illuminate\Http\Request;

class IdeaController extends Controller
{

    private function findIdea($slug)
    {
        $idea = Idea::where('slug', $slug)->first();
        if ($idea) {
            return $idea;
        }
        throw new \Illuminate\Database\Eloquent\ModelNotFoundException();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return redirect()->route('search');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', Idea::class);
        \View::share('pageTitle', 'Buat Ide Baru');
        $tags = Tag::publish()->get()->map(function($tag) {
            return $tag->name; })->toArray();

        return view('idea.create', compact('tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        $this->authorize('store', Idea::class);
        $request->merge(['user_id' => auth()->user()->id]);
        $idea = Idea::create($request->all());
        if ($idea->id) {
            if ($request->file('media')) {
                foreach ($request->file('media') as $photo) {
                    IdeaPhoto::create(['idea_id' => $idea->id, 'url' => $photo]);
                }
            }
            if ($request->get('tag')) {
                $tags = explode(',', $request->get('tag'));
                foreach ($tags as $tag) {
                    IdeaTag::create(['idea_id' => $idea->id, 'name' => $tag]);
                }
            }
        }
        return redirect()->route('idea.show', $idea);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        \View::share('pageTitle', 'Detil Ide');
        $idea = $this->findIdea($slug);
        return view('idea.show', compact('idea'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $idea = $this->findIdea($slug);
        $this->authorize('edit', $idea);
        \View::share('pageTitle', 'Perbaharui Ide');
        $tags = Tag::publish()->get()->map(function($tag) {
            return $tag->name; })->toArray();
        $ideaTags = join(',', $idea->tags->map(function($tag) {
            return $tag->name; })->toArray()
            );
        return view('idea.edit', compact('idea', 'tags', 'ideaTags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, $slug)
    {
        $idea = $this->findIdea($slug);
        $this->authorize('update', $idea);
        $idea->fill($request->all());
        if ($idea->save()) {
            $photos = $request->file('media');
            if ($photos) {
                foreach ($photos as $photo) {
                    IdeaPhoto::create(['idea_id' => $idea->id, 'url' => $photo]);
                }
            }
            if ($request->get('tag')) {
                $ideaTags = $idea->tags;
                $idea->tags()->delete();
                $tags = explode(',', $request->get('tag'));
                foreach ($tags as $tag) {
                    IdeaTag::create(['idea_id' => $idea->id, 'name' => $tag]);
                }   
            }
        }
        return redirect()->route('idea.show', $idea);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug)
    {
        $idea = $this->findIdea($slug);
        $user = $idea->user;
        $idea->delete();
        return redirect()->route('user.show', $user);
    }

    public function join($slug)
    {
        $idea = $this->findIdea($slug);
        if ($idea->members()->find(auth()->user()->id)) {
            return rediret()->back();
        } else {
            $idea->members()->save(auth()->user(), ['join_at' => \Carbon::now(), 'created_at' => \Carbon::now(), 'updated_at' => \Carbon::now()]);
            return redirect()->back();
        }
    }
}
