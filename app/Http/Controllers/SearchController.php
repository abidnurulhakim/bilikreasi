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
    	\View::share('pageTitle', 'Cari Ide');
        $tags = Tag::publish()->get()->map(function($tag) {
            return $tag->name; })->toArray();
        $keyword = $request->get('q', '');
        $filter = [];
        $tagSelected = $request->get('tag', []);
        if (!empty($tagSelected)) {
            $filter['tag'] = $tagSelected;
        }
        if (!empty($request->get('category', ''))) {
            $filter['category'] = $request->get('category');
        }
        if (!empty($request->get('status', ''))) {
            $filter['status'] = $request->get('status');
        }
        $ideas = Idea::search($keyword, $filter)->paginate(10);
        return view('search.index', compact('tags', 'tagSelected', 'ideas'));
    }

    public function partner(PartnerRequest $request, $slug)
    {
        $idea = Idea::where('slug', $slug)->firstOrFail();
        \View::share('pageTitle', 'Cari Partner Untuk Ide '.$idea->title);
        $keyword = $request->get('name', '');
        $skills = Skill::publish()->get()->map(function($skill) {
            return $skill->name; })->toArray();
        $skillSelected = $request->get('skill', []);
        $interests = Interest::publish()->get()->map(function($interest) {
            return $interest->name; })->toArray();
        $interestSelected = $request->get('interest', []);
        $filter = ['not_member_idea' => $idea->id];
        if (!empty($skillSelected)) {
            $filter['skill'] = $skillSelected;
        }
        if (!empty($interestSelected)) {
            $filter['interest'] = $interestSelected;
        }
        $users = User::search($keyword, $filter)->paginate(12);
        return view('partner.index', compact('idea','interests', 'interestSelected', 'skills', 'skillSelected', 'users'));
    }
}
