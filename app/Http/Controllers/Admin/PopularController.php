<?php

namespace App\Http\Controllers\Admin;

use App\Models\Popular;
use App\Http\Requests\Admin\Popular\StoreRequest;
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
        $popular = Tag::findOrFail($id);
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
        $popular = Tag::findOrFail($id);
        $popular->fill($request->all());
        $popular->save();
        return redirect()->route('admin.tag.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $popular = Tag::findOrFail($id);
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
        $popular = Tag::findOrFail($id);
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
        $popular = Tag::findOrFail($id);
        $popular->publish = false;
        $popular->save();
        return redirect()->route('admin.popular.index');
    }
}
