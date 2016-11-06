<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\User\UpdateRequest;
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
    public function show($id)
    {
        \View::share('pageTitle', 'Buat Ide Baru');
        return view('user.show');
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
        $skills = Skill::publish()->get()->map(function($skill) {
            return $skill->name; })->toArray();
        $interests = Interest::publish()->get()->map(function($interest) {
            return $interest->name; })->toArray();
        $user = User::where('username', $username)->first();
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
        $user->photo = $request->file('photo');
        $user->name = $request->get('name');
        $user->gender = $request->get('gender');
        $user->birthday = $request->get('birthday');
        $user->phone_number = $request->get('phone_number');
        if ($request->get('password')) {
            $user->password = $request->get('password');
        }
        // dump($user->photo->move('attachments', 'asal.jpg'));
        if ($user->save()) {
            // dd($request->all());
            $userSkills = $user->skills;
            $userInterests = $user->interests;
            $user->skills()->delete();
            $userSkills = explode(',', $request->get('skill'));
            foreach ($userSkills as $skill) {
                if (strlen($skill) > 0) {
                    UserSkill::create(['user_id' => true, 'name' => ucfirst($skill)]);
                }
            }
            $user->interests()->delete();
            $userInterests = explode(',', $request->get('interest'));
            foreach ($userInterests as $interest) {
                if (strlen($interest) > 0) {
                    UserInterest::create(['user_id' => true, 'name' => ucfirst($interest)]);
                }
            }
        }
        return redirect()->back();
    }
}
