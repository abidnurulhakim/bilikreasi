<?php

namespace App\Http\Controllers\Admin;

use App\Models\Interest;
use App\Http\Requests\Admin\Interest\StoreRequest;
use App\Http\Requests\Admin\Interest\UpdateRequest;
use App\Http\Controllers\Admin\AdminController;

class InterestController extends AdminController
{
    /**
     * Instantiate a new UserController instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        \View::share('interestMenu', true);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $interests = Interest::all();
        return view('admin.interest.index', compact('interests'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.interest.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        $interest = Interest::create($request->all());
        return redirect()->route('admin.interest.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $interest = Interest::findOrFail($id);
        return view('admin.interest.edit', compact('interest'));
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
        $interest = Interest::findOrFail($id);
        $interest->fill($request->all());
        $interest->save();
        return redirect()->route('admin.interest.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $interest = Interest::findOrFail($id);
        $idea->delete();
        return redirect()->route('admin.interest.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function publish($id)
    {
        $interest = Interest::findOrFail($id);
        $interest->publish = true;
        $interest->save();
        return redirect()->route('admin.interest.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function unpublish($id)
    {
        $interest = Interest::findOrFail($id);
        $interest->publish = false;
        $interest->save();
        return redirect()->route('admin.interest.index');
    }
}
