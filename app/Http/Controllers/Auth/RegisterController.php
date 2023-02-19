<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use App\Rules\PhoneNumber;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class RegisterController extends Controller {
	/*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

	use RegistersUsers;

	/**
	 * Where to redirect users after registration.
	 *
	 * @var string
	 */
	protected $redirectTo = '/';

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct() {
		$this->middleware('guest');
	}

	/**
	 * Get a validator for an incoming registration request.
	 *
	 * @param  array  $data
	 * @return \Illuminate\Contracts\Validation\Validator
	 */
	protected function validator(array $data) {
		return Validator::make($data, [
			'user_name' => ['required', 'string', 'max:50'],
			'user_kana' => ['required', 'string', 'regex:/^[ア-ン゛゜ァ-ォャ-ョー]+$/u', 'max:50'],
			'post_code' => ['required', 'regex:/^\d{3}-\d{4}$/'],
			'prefecture' => ['required', 'string', 'max:4'],
			'municipality' => ['required', 'string', 'max:255'],
			'apartment' => ['nullable', 'string', 'max:255'],
			'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->where('user_status', 'active'),],
			'phone_number' => ['required', new PhoneNumber],
			'birthday' => ['required', 'date', 'before_or_equal:today'],
			'gender' => ['required', 'max:10'],
			'nickname' => ['nullable', 'string', 'max:50'],
			'icon' => ['nullable', 'mimes:jpg,jpeg,png,gif'],
			'password' => ['required', 'string', 'min:8', 'confirmed'],
		]);
	}

	/**
	 * Create a new user instance after a valid registration.
	 *
	 * @param  array  $data
	 * @return \App\Models\User
	 */
	protected function create(array $data) {
		if (array_key_exists('icon', $data)) {
			$icon = $data['icon'];
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
		return User::create([
			'user_name' => $data['user_name'],
			'user_kana' => $data['user_kana'],
			'post_code' => $data['post_code'],
			'prefecture' => $data['prefecture'],
			'municipality' => $data['municipality'],
			'apartment' => $data['apartment'],
			'email' => $data['email'],
			'phone_number' => str_replace('-', '', $data['phone_number']),
			'birthday' => $data['birthday'],
			'gender' => $data['gender'],
			'nickname' => $data['nickname'],
			'icon' => $icon_path,
			'password' => Hash::make($data['password']),
		]);
	}
}
