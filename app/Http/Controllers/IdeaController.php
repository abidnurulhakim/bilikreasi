<?php

namespace App\Http\Controllers;

use App\Models\Idea;
use App\Models\IdeaPhoto;
use App\Models\IdeaTag;
use App\Models\Tag;
use App\Http\Requests\Idea\CreateRequest;
use Illuminate\Http\Request;

class IdeaController extends Controller
{

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
    public function store(CreateRequest $request)
    {
        $request->merge(['user_id' => auth()->user()->id]);
        $idea = Idea::create($request->all());
        if ($idea->id) {
            $photos = $request->file('media');
            foreach ($photos as $photo) {
                IdeaPhoto::create(['idea_id' => $idea->id, 'url' => $photo]);
            }
            $tags = explode(',', $request->get('tag'));
            foreach ($tags as $tag) {
                IdeaTag::create(['idea_id' => $idea->id, 'name' => $tag]);
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
    public function show($id)
    {
        \View::share('pageTitle', 'Detail Ide');
        return view('idea.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        \View::share('pageTitle', 'Edit Ide');
        $idea = Idea::where('slug', $slug)->first();
        if (empty($idea)) {
            return redirect(404);
        }
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
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
