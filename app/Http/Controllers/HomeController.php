<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Gate;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
//    public function index()
//    {
//        if(Gate::allows('isSuper')){
//            return redirect('/');
//        }elseif (Gate::allows('isManager')){
//            return redirect('/dashboard-GM');
//        }elseif (Gate::allows('isReceptionist')){
//            return redirect('/front-desk');
//        }elseif (Gate::allows('isDeputyManager')){
//            return redirect('/dm-panel');
//        }else{
//            Auth::logout();
//            return redirect('/login');
//           // abort('404','you cannot access here');
//        }
//
//
//    }
}
