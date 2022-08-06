<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

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
    public function index(): \Illuminate\Contracts\Support\Renderable
    {
        $userCount = $this->countUsers();
        return view('home', compact('userCount'));
    }

    public function countUsers(): int
    {
        $userCount = User::all()->count();
        //Log::debug('bla bla ' . $userCount );
        return $userCount;
    }
}
