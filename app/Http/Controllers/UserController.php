<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller {
	protected function info() {
		$user = Auth::user();
		return view('user/user_info', [
			'user' => $user
		]);
	}
	protected function seller_request() {
		$user = User::find(Auth::user()->id);
		$user->seller = 3;
		$user->save();
		return redirect()->route('user_info');
	}

	protected function seller_request_list() {
		$seller_requests = User::where('user_status', 'active')->where('seller', 3)->where('admin', 0)->get();
		$sellers = User::where('user_status', 'active')->where('seller', 1)->where('admin', 0)->get();
		return view('admin/seller_request_list', ['seller_requests' => $seller_requests, 'sellers' => $sellers]);
	}
	protected function seller_info($user_id) {
		$user = User::find($user_id);
		return view('admin/seller_info',['user'=>$user]);
	}
	protected function seller_update($user_id) {
		$seller = User::find($user_id);
		$seller->seller = 1;
		$seller->save();
		return redirect()->route('seller_request_list');
	}
	protected function seller_delete($user_id) {
		$seller = User::find($user_id);
		$seller->seller = 0;
		$seller->save();
		return redirect()->route('seller_request_list');
	}
}
