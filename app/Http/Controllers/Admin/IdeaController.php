<?php

namespace App\Http\Controllers\Admin;

use App\Models\Idea;
use App\Models\IdeaMedia;
use App\Models\IdeaTag;
use App\Models\Tag;
use App\Http\Requests\Admin\Idea\StoreRequest;
use App\Http\Requests\Admin\Idea\UpdateRequest;
use App\Http\Controllers\Admin\AdminController;

class IdeaController extends AdminController
{
    /**
     * Instantiate a new UserController instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        \View::share('ideaMenu', true);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ideas = Idea::all();
        return view('admin.idea.index', compact('ideas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tags = [];
        foreach (Tag::publish()->get() as $tag) {
            $tags[$tag->name] = $tag->name;
        }
        return view('admin.idea.create', compact('tags'));
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
                    if ($photo) {
                        IdeaMedia::create(['idea_id' => $idea->id, 'url' => $photo]);
                    }
                }
            }
        }
        return redirect()->route('admin.idea.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $idea = Idea::where('slug', $slug)->firstOrFail();
        $this->authorize('edit', $idea);
        $tags = [];
        foreach (Tag::publish()->get() as $tag) {
            $tags[$tag->name] = $tag->name;
        }
        return view('admin.idea.edit', compact('idea', 'tags'));
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
        }
        return redirect()->route('admin.idea.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug)
    {
        $idea = Idea::where('slug', $slug)->firstOrFail();
        $idea->delete();
        return redirect()->route('admin.idea.index');
    }
}
