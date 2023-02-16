<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    protected function info(){
		$user = Auth::user();
		return view('user/user_info',[
			'user'=>$user
		]);
	}
}
