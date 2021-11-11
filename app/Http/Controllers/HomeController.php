<?php

namespace App\Http\Controllers;

use App\Models\Url;
use App\Models\User;
use Illuminate\Http\Request;
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
    public function index()
    {
        if (Auth::user()->admin == 1) {
            $url = Url::latest();
            $url_views = $url->sum('views');
            $urls_count = $url->count();
            $urls = $url->get();

            $users = User::latest();
            $users_count = $users->count();
            $users = $users->get();
            return view('dashboard', compact('urls', 'url_views', 'urls_count', 'users_count', 'users'));
        }
        $urls = auth()->user()->url()->latest()->get();
        return view('dashboard', compact('urls'));
    }
}
