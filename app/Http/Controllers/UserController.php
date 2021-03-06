<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Skill;
use App\Models\UserSkill;
use App\Models\Interest;
use App\Models\UserInterest;
use App\Services\UserService;
use App\Http\Requests\User\UpdateRequest;
use App\Http\Requests\User\ChangePasswordRequest;
use Illuminate\Http\Request;
use Illuminate\Support\MessageBag;

class UserController extends Controller
{

    /**
     * Instantiate a new UserController instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->middleware('auth', ['except' => [
            'show',
        ]]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($username)
    {
        \View::share('pageHeader', false);
        $user = User::where('username', $username)->firstOrFail();
        if (empty($user)) {
            return redirect(404);
        }
        $ideas = $user->memberOf()->paginate(12);
        if (Request()->ajax()) {
            return view('user.show-ajax', compact('ideas'));
        }
        return view('user.show', compact('user', 'ideas'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($username)
    {
        \View::share('pageTitle', 'Perbaharui Profil');
        $user = User::where('username', $username)->firstOrFail();
        $skills = [];
        foreach (Skill::publish()->get() as $skill) {
            $skills[$skill->name] = $skill->name;
        }
        $interests = [];
        foreach (Interest::publish()->get() as $interest) {
            $interests[$interest->name] = $interest->name;
        }
        return view('user.edit', compact('user', 'skills', 'interests'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, $username)
    {
        $user = User::where('username', $username)->firstOrFail();
        if (is_null($user)) {
            return redirect()->back();
        }
        $user->fill($request->all());
        if ($user->save()) {
            \Session::flash('success', 'Profil berhasil diperbaharui');
            return redirect()->back();
        } else {
            \Session::flash('alert', 'Profil gagal diperbaharui');
            return redirect()->back()->withInput();
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editPassword($username)
    {
        \View::share('pageTitle', 'Ganti Password');
        $user = User::where('username', $username)->firstOrFail();
        return view('user.change-password', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updatePassword(ChangePasswordRequest $request, $username)
    {
        $user = User::where('username', $username)->firstOrFail();
        if (is_null($user)) {
            return redirect()->back();
        }
        $errors = new MessageBag();
        if (!UserService::changePassword($user, $request->get('old_password'), $request->get('password'))) {
            $errors->add('old_password', 'Password lama kamu tidak benar.');
            \Session::flash('alert', 'Perubahan password gagal');
        } else {
            \Session::flash('success', 'Perubahan password berhasil');
        }
        return redirect()->back()->withErrors($errors);
    }

    public function invitation($username)
    {
        \View::share('pageHeader', false);
        $user = User::where('username', $username)->firstOrFail();
        $invitations = $user->invitations()->paginate(6);
        if (Request()->ajax()) {
            return view('user.invitation-ajax', compact('user', 'invitations'));
        }
        return view('user.invitation', compact('user', 'invitations'));
    }
}
