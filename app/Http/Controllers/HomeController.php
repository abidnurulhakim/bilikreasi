<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Popular;
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
        $banners = Banner::publish()->get();
        $populars = Popular::publish()->get();
        return view('home.index', compact('banners', 'populars'));
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
