<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/a', function () {
    return view('auth/passwords/confirm');
});





Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/', [App\Http\Controllers\ProductController::class, 'index'])->name('index');
Route::get('/detail/{product_id}', [App\Http\Controllers\ProductController::class, 'detail'])->name('detail');

Route::middleware(['auth', 'verified'])->group(function () {
	//  会員以外見られたくないルート設定
	Route::get('/user_info', [\App\Http\Controllers\UserController::class, 'info'])->name('user_info');
	Route::get('/review_list', [\App\Http\Controllers\ReviewController::class, 'review_list'])->name('review_list');
	Route::get('/inquiry_list', [\App\Http\Controllers\InquiryController::class, 'inquiry_list'])->name('inquiry_list');
	Route::get('/post_list', [\App\Http\Controllers\PostController::class, 'post_list'])->name('post_list');
	Route::get('/review_like_list', [\App\Http\Controllers\ReviewController::class, 'review_like_list'])->name('review_like_list');
	Route::get('/inquiry_like_list', [\App\Http\Controllers\InquiryController::class, 'inquiry_like_list'])->name('inquiry_like_list');
	Route::get('/post_like_list', [\App\Http\Controllers\PostController::class, 'post_like_list'])->name('post_like_list');
});
Route::middleware(['auth', 'seller'])->group(function () {
	//  販売者以外見られたくないルート設定
	Route::get('/seller_index', function () {
		return view('seller/seller_index');
	})->name('seller_index');
	Route::get('/product_register', [App\Http\Controllers\ProductCategoryController::class, 'index'])->name('product_register_form');
	Route::get('/kind_register', [\App\Http\Controllers\KindController::class, 'index']);
	Route::post('/kind_register', [App\Http\Controllers\ProductController::class, 'product_register'])->name('product_register');
	Route::get('/product_list', [App\Http\Controllers\ProductController::class, 'product_list'])->name('product_list');
	Route::post('/product_list', [App\Http\Controllers\KindController::class, 'kind_register'])->name('kind_register');
});
Route::middleware(['auth', 'admin'])->group(function () {
	//  管理者以外見られたくないルート設定
	Route::get('/admin_index', function () {
		return view('admin/admin_index');
	})->name('admin_index');
	Route::get('/category_register', [App\Http\Controllers\ProductCategoryController::class, 'category_form'])->name('category_form');
	Route::post('/category_register', [App\Http\Controllers\ProductCategoryController::class, 'category_register'])->name('category_register');
});






use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
Route::get('/forgot-password', function () {
	return view('auth/passwords/email');
})->middleware('guest')->name('password.request');

Route::post('/forgot-password', function (Request $request) {
	$request->validate(['email' => 'required|email']);

	$status = Password::sendResetLink(
		$request->only('email')
	);

	return $status === Password::RESET_LINK_SENT
		? back()->with(['status' => __($status)])
		: back()->withErrors(['email' => __($status)]);
})->middleware('guest')->name('password.email');

Route::get('/reset-password/{token}', function ($token) {
	return view('auth/passwords/reset', ['token' => $token]);
})->middleware('guest')->name('password.reset');

Route::post('/reset-password', function (Request $request) {
	$request->validate([
		'token' => 'required',
		'email' => 'required|email',
		'password' => 'required|min:8|confirmed',
	]);

	$status = Password::reset(
		$request->only('email', 'password', 'password_confirmation', 'token'),
		function ($user, $password) {
			$user->forceFill([
				'password' => Hash::make($password)
			])->setRememberToken(Str::random(60));

			$user->save();

			event(new PasswordReset($user));
		}
	);

	return $status === Password::PASSWORD_RESET
		? redirect()->route('login')->with('status', __($status))
		: back()->withErrors(['email' => [__($status)]]);
})->middleware('guest')->name('password.update');