<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

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

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     * optional 
     * @return void
     */
    public function __construct()
    {
         $this->middleware('guest')->except('logout');
        $this->middleware('guest:admin')->except('logout');
    }
    
    /**
     * showAdminLoginForm
     * showing admin login
     * @return void
     */
    public function showAdminLoginForm()
    {
        return view('admin.auth.login');
    }
    
    /**
     * adminLogin
     * For login admin
     * 
     * @param  mixed $request
     * @return void
     */
    public function adminLogin(Request $request)
    {
        $this->validate($request, [
            'login'   => 'required',
            'password' => 'required|min:6'
        ]);

        $login_type = filter_var($request->input('login'), FILTER_VALIDATE_EMAIL ) 
        ? 'email' 
        : 'username';

    $request->merge([
        $login_type => $request->input('login')
    ]);



        if (\Auth::guard('admin')->attempt($request->only($login_type,'password'), $request->get('remember'))){
            return redirect()->intended('/admin/dashboard');
        }

        return redirect()->back()->withInput($request->only('login', 'remember'))
        ->withErrors([
            'login' => 'These credentials do not match our records.',
        ]);;
    }


}
