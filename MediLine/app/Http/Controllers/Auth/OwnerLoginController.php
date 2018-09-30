<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

class OwnerLoginController extends Controller
{

    public function showLoginForm(){
        return view('auth.owner-login');
    }

    public function login(Request $request){
        //validate data
        $this->validate($request,[
            'email' => 'required|email',
            'password' => 'required|min:6'
        ]);
        //attempt to log the user in
        if (auth()->guard('owner')->attempt(['email'=> $request->email, 'password'=>$request->password], $request->remember)){
            //redirect if successful
            return redirect()->route('owner.index');
        }
        //redirect back to login form if unsuccessful
        return redirect()->back()->withInput($request->only('email', 'remember'));
    }


    public function logout()
    {
        Auth::guard('owner')->logout();

        return redirect('/');
    }

}
