<?php
namespace App\Http\Controllers;
use App\Models\User;
use Auth;
use Illuminate\Http\Request;

class AuthController extends Controller
{
  
    //sign in functions
    public function getSignin()
    {
      return view('auth.signin');
    }
    
    public function postSignin(Request $request)
    {
    
      $user = array(
            'email' => $request->input('email'),
            'password' => $request->input('password'),
        );

      if (Auth::attempt($user,$request->has('remember'))) {
            return redirect()
                   ->route('home')
                   ->withInfo('You are now signed in');
      }
      return redirect()
                    ->back()
                    ->withInfo('Coudnot sign in with those details');
    }
    
    //sign up functions
    public function getSignup()
    {
      return view('auth.signup');
    }

    public function postSignUp(Request $request)
    {
       $this->validate($request ,[
          'email'   => 'required|unique:users|max:255|email',
          'username'=> 'required|max:25',
          'password'=> 'required|min:6',
       ]);

       $current_user= User::firstOrCreate([
          'email' => $request->input('email'),
          'username' => $request->input('username'),
          'password' => bcrypt($request->input('password')),
       ]);
      
      $request->session()->put('current_user', $current_user);
      return redirect()
        ->route('auth.signin')
        ->withInfo('You are registered successfully, Login to complete ur account info');
    }

   
    public function getSignout()
    {
        Auth::logout();
        return redirect()->route('home');
    }

}