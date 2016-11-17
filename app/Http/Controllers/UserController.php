<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Skill;
use App\Models\UserSkill;
use App\Models\Interest;
use App\Models\UserInterest;
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
        \View::share('pageTitle', 'Buat Ide Baru');
        $user = $this->findUser($username);
        if (empty($user)) {
            return redirect(404);
        }
        $ideas = $user->memberOf()->paginate(9);
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
        $user = $this->findUser($username);
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
        $user = $this->findUser($username);
        if (is_null($user)) {
            return redirect()->back();
        }
        $user->fill($request->all());
        if ($user->save()) {
            $user->skills()->delete();
            $userSkills = explode(',', $request->get('skill'));
            foreach ($userSkills as $skill) {
                if (strlen($skill) > 0) {
                    UserSkill::create(['user_id' => $user->id, 'name' => $skill]);
                }
            }
            $user->interests()->delete();
            $userInterests = explode(',', $request->get('interest'));
            foreach ($userInterests as $interest) {
                if (strlen($interest) > 0) {
                    UserInterest::create(['user_id' => $user->id, 'name' => $interest]);
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
        $user = $this->findUser($username);
        return view('user.change-password');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updatePassword(ChangePasswordRequest $request, $username)
    {
        $user = $this->findUser($username);
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

    private function findUser($username)
    {
        $user = User::where('username', $username)->first();
        if ($user) {
            return $user;
        }
        throw new \Illuminate\Database\Eloquent\ModelNotFoundException();
    }
}
