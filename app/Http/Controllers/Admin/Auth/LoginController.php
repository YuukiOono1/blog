<?php

namespace App\Http\Controllers\Admin\Auth; // Admin追加

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // ガードのカスタマイズで必須
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

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
    protected $redirectTo = RouteServiceProvider::ADMIN_HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function showLoginForm()
    {
        return view('admin.auth.login');
    }

    // ログアウト先を変更したい場合はuse AuthenticateUsers先のloggedOutメソッドをオーバーライドする　
    protected function loggedOut(Request $request)
    {
        return redirect(route('admin.login'));
    }

    protected function guard()
    {
        return Auth::guard('admin');
    }

    // あるいはログアウトメソッドに追記
    //public function logout(Request $request)
    //{
        //$this->guard()->logout();

        //$request->session()->invalidate();
        //return $this->loggedOut($request) ?: redirect('/admin/login');　loggedOutの戻り値がなければ
    //}
}
