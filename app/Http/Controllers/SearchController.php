<?php

namespace App\Http\Controllers;

use App\Models\Idea;
use App\Models\Interest;
use App\Models\Skill;
use App\Models\Tag;
use App\Models\User;
use App\Http\Requests\Search\IndexRequest;
use App\Http\Requests\Search\PartnerRequest;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(IndexRequest $request)
    {
    	\View::share('pageHeader', false);
        $tags = [];
        foreach (Tag::publish()->get() as $tag){
            $tags[$tag->name] = $tag->name;
        }
        $keyword = $request->get('q', '');
        $filter = [];
        if (!empty($tagSelected)) {
            $filter['tags'] = $tagSelected;
        }
        if (!empty($request->get('category', ''))) {
            $filter['category'] = $request->get('category');
        }
        if (!empty($request->get('status', ''))) {
            $filter['status'] = $request->get('status');
        }
        $ideas = Idea::search($keyword, $filter)->paginate(12);
        $ideas->appends($request->all());
        if (Request()->ajax()) {
            return view('search.index-ajax', compact('ideas'));
        }
        return view('search.index', compact('tags', 'tagSelected', 'ideas'));
    }

    public function partner(PartnerRequest $request, $slug)
    {
        $idea = Idea::where('slug', $slug)->firstOrFail();
        \View::share('pageTitle', 'Cari Partner Untuk Ide \''.$idea->title.'\'');
        $keyword = $request->get('name', '');
        $skills = [];
        foreach (Skill::publish()->get() as $skill) {
            $skills[$skill->name] = $skill->name;
        }
        $interests = [];
        foreach (Interest::publish()->get() as $interest) {
            $interests[$interest->name] = $interest->name;
        }
        $skillSelected = $request->get('skills', []);
        $interestSelected = $request->get('interests', []);
        $filter = ['not_member_idea' => $idea->id];
        if (!empty($skillSelected)) {
            $filter['skills'] = $skillSelected;
        }
        if (!empty($interestSelected)) {
            $filter['interests'] = $interestSelected;
        }
        $users = User::search($keyword, $filter)->paginate(9);
        $users->appends($request->all());
        if (Request()->ajax()) {
            return view('partner.index-ajax', compact('users', 'idea'));
        }
        return view('partner.index', compact('idea','interests', 'interestSelected', 'skills', 'skillSelected', 'users'));
    }
}
