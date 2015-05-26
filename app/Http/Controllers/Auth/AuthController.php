<?php namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\Registrar;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

class AuthController extends Controller {
	/*
	|--------------------------------------------------------------------------
	| Registration & Login Controller
	|--------------------------------------------------------------------------
	|
	| This controller handles the registration of new users, as well as the
	| authentication of existing users. By default, this controller uses
	| a simple trait to add these behaviors. Why don't you explore it?
	|
	*/

	use AuthenticatesAndRegistersUsers;

	/**
	 * Create a new authentication controller instance.
	 *
	 * @param  \Illuminate\Contracts\Auth\Guard  $auth
	 * @param  \Illuminate\Contracts\Auth\Registrar  $registrar
	 * @return void
	 */
	public function __construct(Guard $auth, Registrar $registrar)
	{
		$this->auth = $auth;
		$this->registrar = $registrar;
		$this->middleware('guest', ['except' => 'getLogout']);
	}

	/**
	 * Register disabled
	 * @return \Illuminate\Http\Response
	 */
	public function getRegister()
	{
		return redirect('auth/login');die;
	}

	/**
	 * Handle a registration request for the application.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function postRegister(Request $request)
	{
		return redirect('auth/login');die;
	}

	/**
	 * Login formunu gösterelim.
	 *
	 * @return Response
	 */
	public function getLogin()
	{
		return view('mtcms.auth.login');
	}

	/**
	 * Handle a login request to the application.
	 *
	 * @param  Request  $request
	 * @return Response
	 */
	public function postLogin(Request $request)
	{
		$this->validate($request,['email' => 'required|email', 'password' => 'required']);
		$request->offsetSet('status',1);
		if ($this->auth->attempt($request->only('email', 'password','status'))){
			return redirect('/dashboard');
		}else{
			return redirect('/auth/login')->withErrors(['email' => 'E-Posta veya Parola bilgileriniz hatalı!']);
		}
	}
}
