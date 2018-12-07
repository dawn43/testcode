<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Role;

class HomeController extends Controller
{
    public function index($id){
    	$user = User::findOrFail($id);
    	$role = Role::findOrFail($id);
		$data = [
			'user_id' => $user->id,
			'user_name' => $user->name,
			'user_email' => $user->email,
			'role_id' => $role->id,
			'role' => $role->role
		];
    	return view('forms.home')->with('dataUser', $data);
    }
}
