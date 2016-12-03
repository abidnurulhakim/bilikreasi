<?php

namespace App\Http\Controllers\Admin;

use App\Models\Idea;
use App\Models\Popular;
use App\Models\PopularIdea;
use App\Http\Requests\Admin\Popular\StoreRequest;
use App\Http\Requests\Admin\Popular\StoreIdeaRequest;
use App\Http\Requests\Admin\Popular\UpdateRequest;
use App\Http\Controllers\Admin\AdminController;

class PopularController extends AdminController
{
    /**
     * Instantiate a new UserController instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        \View::share('popularMenu', true);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $populars = Popular::orderBy('order_number')->get();
        return view('admin.popular.index', compact('populars'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $popular = Popular::findOrFail($id);
        $popularIdeas = $popular->ideas;
        return view('admin.popular.show', compact('popular', 'popularIdeas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.popular.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        $popular = Popular::create($request->all());
        return redirect()->route('admin.popular.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $popular = Popular::findOrFail($id);
        return view('admin.popular.edit', compact('popular'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, $id)
    {
        $popular = Popular::findOrFail($id);
        $popular->fill($request->all());
        $popular->save();
        return redirect()->route('admin.popular.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $popular = Popular::findOrFail($id);
        $popular->delete();
        return redirect()->route('admin.popular.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function publish($id)
    {
        $popular = Popular::findOrFail($id);
        $popular->publish = true;
        $popular->save();
        return redirect()->route('admin.popular.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function unpublish($id)
    {
        $popular = Popular::findOrFail($id);
        $popular->publish = false;
        $popular->save();
        return redirect()->route('admin.popular.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createIdea($id)
    {
        $popular = Popular::findOrFail($id);
        $popularIdea = $popular->ideas->map(function($idea) {
            return $idea->idea_id; })->toArray();
        $ideas = [];
        foreach (Idea::all() as $idea) {
            if (!in_array($idea->id, $popularIdea)) {
                $ideas["$idea->id"] = $idea->title;
            }
        }
        return view('admin.popular.idea-create', compact('popular', 'ideas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeIdea(StoreIdeaRequest $request, $id)
    {
        $popularIdea = new PopularIdea();
        $popularIdea->popular_id = $id;
        $popularIdea->idea_id = $request->get('idea');
        $popularIdea->order_number = $request->get('order_number');
        $popularIdea->save();
        return redirect()->route('admin.popular.show', ['id' => $id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroyIdea($id)
    {
        $popularIdea = PopularIdea::findOrFail($id);
        $popular = $popularIdea->idea_id;
        $popularIdea->delete();
        return redirect()->route('admin.popular.show', ['id' => $popular]);
    }
}
