<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        \View::share('pageHeader', false);
        $ideas = \App\Models\Idea::orderBy('like_count', 'desc')->take(9)->get();
        return view('home.index', compact('ideas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function login()
    {
        \View::share('pageHeader', false);
        return view('home.login');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function register()
    {
        \View::share('pageHeader', false);
        return view('home.register');
    }

}
