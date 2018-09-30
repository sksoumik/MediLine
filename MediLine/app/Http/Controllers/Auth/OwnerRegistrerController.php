<?php

namespace App\Http\Controllers\Auth;

use App\Owner;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class OwnerRegistrerController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest:owner');
    }

    public function showRegisterForm(){
        return view('auth.owner-register');
    }

    public function register(Request $request){
        //validate data
        $this->validate($request,[
            'email' => 'required|email',
            'password' => 'required|min:6',
            'pharmacy_name' => 'required|max:50',
            'address' => 'required|max:120',
            'phone' => 'required|max:11|min:8'
        ]);
        //save owner user to the database

        $owner = new Owner([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
            'pharmacy_name' => $request->input('pharmacy_name'),
            'address' => $request->input('address'),
            'phone' => $request->input('phone')
        ]);

        $owner->save();
        //login the owner user
        return redirect()->route('owner.dashboard')->with('owner', $owner);
        //redirect back to register form if unsuccessful

    }


    public function logout()
    {
        Auth::guard('owner')->logout();

        return redirect('/');
    }

}
