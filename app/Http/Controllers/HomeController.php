<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Popular;
use App\Models\User;
use App\Services\UserService;
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

    public function accountConfirmation(Request $request, $id)
    {
        if ($request->get('token') && UserService::confirmation($id, $request->get('token'))) {
            \Session::flash('success', "Terima kasih konfirmasi akun Anda");
        } else {
            \Session::flash('error', "Token Anda tidak sesuai");
        }
        $user = User::find($id);
        if ($user) {
            return redirect()->route('user.show', $user);
        }
        return redirect()->route('home.login');
    }
}
