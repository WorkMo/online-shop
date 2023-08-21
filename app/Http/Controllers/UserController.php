<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use App\Rules\PhoneNumber;
use Illuminate\Validation\Rule;

class UserController extends Controller {
	protected function info() {
		$user = Auth::user();
		return view('user/user_info', [
			'user' => $user
		]);
	}
	protected function edit_form() {
		$user = Auth::user();
		return view('user/user_edit', [
			'user' => $user
		]);
	}
	protected function edit(Request $request) {
		$request_data=$request->all();
		$user = User::find(Auth::user()->id);

		$request->validate([
			'user_name' => ['required', 'string', 'max:50'],
			'user_kana' => ['required', 'string', 'regex:/^[ア-ン゛゜ァ-ォャ-ョー]+$/u', 'max:50'],
			'post_code' => ['required', 'regex:/^\d{3}-\d{4}$/'],
			'prefecture' => ['required', 'string', 'max:4'],
			'municipality' => ['required', 'string', 'max:255'],
			'apartment' => ['nullable', 'string', 'max:255'],
			'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore(Auth::user()->id)->where('user_status', 'active')],
			'phone_number' => ['required', new PhoneNumber],
			'birthday' => ['required', 'date', 'before_or_equal:today'],
			'gender' => ['required', 'max:10'],
			'nickname' => ['nullable', 'string', 'max:50'],
			'icon' => ['nullable', 'mimes:jpg,jpeg,png,gif'],
			'password' => ['nullable', 'string', 'min:8', 'confirmed'],
		]);

		if (array_key_exists('icon', $request_data)) {

			$icon = $request->icon;
			$time = now();
			$icon_name = $time . '_' . $icon->getClientOriginalName();
			$id = (User::count()) + 1;
			$icon_path = 'storage/icon/' . $id . '/' . $icon_name;
			if (mb_strlen($icon_path) > 255) {
				$icon->storeAs('public/icon/' . $id, $time . '_icon_image');
				$icon_path = 'storage/icon/' . $id . '/' . $time . '_icon_image';
			} else {
				$icon->storeAs('public/icon/' . $id, $icon_name);
			}
		} else {
			$icon_path = 'storage/img/profile.png';
		}
		$user->user_name = $request->user_name;
		$user->user_kana = $request->user_kana;
		$user->post_code = $request->post_code;
		$user->prefecture = $request->prefecture;
		$user->municipality = $request->municipality;
		$user->apartment = $request->apartment;
		$user->email = $request->email;
		$user->phone_number = str_replace('-', '', $request->phone_number);
		$user->birthday = $request->birthday;
		$user->gender = $request->gender;
		$user->nickname = $request->nickname;
		$user->icon = $icon_path;
		if(isset($request->password)){
			$user->password = Hash::make($request->password);}
		$user->save();
		return redirect()->route('user_info');
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
		return view('admin/seller_info', ['user' => $user]);
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
