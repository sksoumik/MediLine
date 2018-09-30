<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use DB;
class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;
    protected function authenticated(Request $request, $user)
    {
        if ( $user->adminFlag == false) {
            return redirect('/profile/' . $user->id);
        }
        return redirect('/Dashboard');
    }
    /**
     * Where to redirect users after login.
     *
     * @var string
     */


        protected $redirectTo = '/Dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * Redirect the user to the facebook authentication page.
     *
     * @return \Illuminate\Http\Response
     */
    public function redirectToFacebook()
    {
        return Socialite::driver('facebook')->redirect();
    }

    /**
     * Obtain the user information from facebook.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleFacebookCallback()
    {
        $userSocial = Socialite::driver('facebook')->user();
       // dd($userSocial);
      //  return $userSocial->name;
        $findUser = User::where('email', $userSocial->email)->first();



        if ($findUser){
            Auth::login($findUser);
//                return view('/profiles.showProfile')->with('user', $findUser);
            return redirect('/profile/' . $findUser->id);
        }
        else{
            $user = new User;
            $user->name = $userSocial->name;
            $user->email = $userSocial->email;
            $user->password = bcrypt(123456);
            $user->cover_image = $userSocial->getAvatar();
            $user->save();

            Auth::login($user);
           //     return view('/profiles.showProfile')->with('user', $user);
            return redirect('/profile/' . $user->id);
        }

    }

    public function userLogout()
    {
        Auth::guard('web')->logout();

        return redirect('/');
    }
}
