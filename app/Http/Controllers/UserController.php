<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\MessageBag;
use App\Http\Requests\User\UpdateRequest;
use App\Http\Requests\User\ChangePasswordRequest;
use App\Models\User;
use App\Models\Skill;
use App\Models\UserSkill;
use App\Models\Interest;
use App\Models\UserInterest;

class UserController extends Controller
{

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($username)
    {
        \View::share('pageTitle', 'Buat Ide Baru');
        $user = User::where('username', $username)->first();
        return view('user.show', compact('user'));
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
        $user = User::where('username', $username)->first();
        $skills = Skill::publish()->get()->map(function($skill) {
            return $skill->name; })->toArray();
        $interests = Interest::publish()->get()->map(function($interest) {
            return $interest->name; })->toArray();
        $userSkills = join(',', $user->skills->map(function($skill) {
            return $skill->name; })->toArray()
            );
        $userInterests = join(',', $user->interests->map(function($interest) {
            return $interest->name; })->toArray()
            );
        return view('user.edit', compact('user', 'skills', 'interests', 'userSkills', 'userInterests'));
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
        $user = User::where('username', $username)->first();
        if (is_null($user)) {
            return redirect()->back();
        }
        $user->fill($request->all());
        if ($user->save()) {
            $user->skills()->delete();
            $userSkills = explode(',', $request->get('skill'));
            foreach ($userSkills as $skill) {
                if (strlen($skill) > 0) {
                    UserSkill::create(['user_id' => $user->id, 'name' => ucfirst($skill)]);
                }
            }
            $user->interests()->delete();
            $userInterests = explode(',', $request->get('interest'));
            foreach ($userInterests as $interest) {
                if (strlen($interest) > 0) {
                    UserInterest::create(['user_id' => $user->id, 'name' => ucfirst($interest)]);
                }
            }
        }
        return redirect()->back();
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
        $user = User::where('username', $username)->first();
        if (is_null($user)) {
            return redirect()->back();
        }
        $errors = new MessageBag();
        if (!\Hash::check($request->get('old_password'), $user->getOriginal('password'))) {
            $errors->add('old_password', 'Your password is wrong.');
        } else {
            $user->password = $request->get('password');
            $user->save();
        }
        return redirect()->back()->withErrors($errors);
    }
}
