<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Auth;

class LoginController extends Controller
{
    public function index(){
    	return view('forms.login');
    }

    public function checkLogin(Request $request){
    	$this->validate($request, [
    		'email'		=>	'required|email',
    		'password'	=>	'required|alphaNum|min:3'
    	]);

    	$userData = [
    		'email'		=>	$request->get('email'),
    		'password'	=>	$request->get('password')
    	];

    	if (Auth::attempt($userData)) {
    		$url = '/home/'.Auth::id();
    		return redirect($url);
    	}
    	else{
    		return back()->with('error', 'Salah Username atau Password');
    	}

    }

    public function logout(){
    	Auth::logout();
    	return redirect('/login');
    }
}
