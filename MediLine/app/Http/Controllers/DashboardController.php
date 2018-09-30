<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Pagination\Paginator;


class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['show']]);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::paginate(10);
        return view('dashboard')->with('users', $users);
    }

    public function show($id)
    {
        $user = User::find($id);
        return view('profiles.showProfile')->With('user', $user);
    }

    public function destroy($id){
        $user = User::find($id);
        $user->delete();
        return redirect('/Dashboard')->with('success', 'User Removed');
    }

}
