<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\Idea;
use App\Http\Requests\Search\IndexRequest;
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
}
