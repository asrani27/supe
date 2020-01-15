<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Feed;
use Auth;
use App\DataCount;
use App\DataMaster;
use App\Semester;
use App\Setting;
use App\User;
use App\Sekolah;

class HomeController extends Controller
{
    /** 
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if(Auth::user()->hasRole('sekolah'))
        {
            $data = Auth::user();
            $sekolah = $data->sekolah;
            return view('sekolah.dashboard',compact('data','sekolah'));
        }
        elseif(Auth::user()->hasRole('superadmin'))
        {
            $data = Auth::user();
            $sekolah = count(Sekolah::all());
            $user = count(User::all());
            return view('superadmin.dashboard.dashboard',compact('data','sekolah','user'));
        }
        else
        {
            return view('noakses');
        }
    }
}
