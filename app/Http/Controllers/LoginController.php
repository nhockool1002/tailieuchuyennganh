<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use Auth;
use App\Log; 
use Illuminate\Support\MessageBag;

class LoginController extends Controller
{
    public function getLogin() {
        if(Auth::check()) {
            return redirect(route('home'));
        }
    	return view('login.login');
    }

    public function postLogin(Request $request) {
    	$rules = [
    		'username' =>'required',
    		'password' => 'required'
    	];
    	$messages = [
    		'email.required' => 'Email là trường bắt buộc',
    		'password.required' => 'Mật khẩu là trường bắt buộc',
    	];
    	$validator = Validator::make($request->all(), $rules, $messages);

    	if ($validator->fails()) {
    		return redirect()->back()->withErrors($validator)->withInput();
    	} else {
    		$username = $request->input('username');
    		$password = $request->input('password');

    		if( Auth::attempt(['username' => $username, 'password' =>$password])) {
                $log = new Log();
                $log->changelog = 'User '.'<b><font color="purple">'.Auth::user()->username.'</font></b> login successfully';
                $log->user = Auth::user()->username;
                $log->screen = \Constant::LOGIN_USER_FUNCTION;
                $log->save();

    			return redirect()->intended('/backend');
    		} else {
    			$errors = new MessageBag(['errorlogin' => 'Username hoặc mật khẩu không đúng']);
    			return redirect()->back()->withInput()->withErrors($errors);
    		}
    	}
    }

    public function getLogout() {
        if(Auth::check()){
            $log = new Log();
            $log->changelog = 'User '.'<b><font color="green">'.Auth::user()->username.'</font></b> logout successfully';
            $log->user = Auth::user()->username;
            $log->screen = \Constant::LOGIN_USER_FUNCTION;
            $log->save();
            Auth::logout();
            return redirect(route('getLogin'))->with('success_mesage','Logout successfully');
        }
    }
}
