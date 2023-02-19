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


Auth::routes();

Route::get('/message', [App\Http\Controllers\HomeController::class, 'index'])->name('message');
Route::get('/', [App\Http\Controllers\ProductController::class, 'index'])->name('index');
Route::get('/detail/{product_id}', [App\Http\Controllers\ProductController::class, 'detail'])->name('detail');
Route::get('/search', [App\Http\Controllers\ProductController::class, 'search'])->name('search');



Route::middleware(['auth', 'verified'])->group(function () {
	//  会員以外見られたくないルート設定
	Route::get('/user_info', [\App\Http\Controllers\UserController::class, 'info'])->name('user_info');
	Route::get('/seller_request', [\App\Http\Controllers\UserController::class, 'seller_request'])->name('seller_request');
	Route::get('/review_list', [\App\Http\Controllers\ReviewController::class, 'review_list'])->name('review_list');
	Route::get('/inquiry_list', [\App\Http\Controllers\InquiryController::class, 'inquiry_list'])->name('inquiry_list');
	Route::get('/post_list', [\App\Http\Controllers\PostController::class, 'post_list'])->name('post_list');

	Route::get('/review_like_list', [\App\Http\Controllers\ReviewController::class, 'review_like_list'])->name('review_like_list');
	Route::get('/inquiry_like_list', [\App\Http\Controllers\InquiryController::class, 'inquiry_like_list'])->name('inquiry_like_list');
	Route::get('/post_like_list', [\App\Http\Controllers\PostController::class, 'post_like_list'])->name('post_like_list');

	Route::post('/cart', [App\Http\Controllers\CartController::class, 'cart_add'])->name('cart_add');
	Route::get('/cart', [App\Http\Controllers\CartController::class, 'cart'])->name('cart');
	Route::get('/cart_delete/{cart_id}', [App\Http\Controllers\CartController::class, 'cart_delete'])->name('cart_delete');
	Route::post('/cart_update', [App\Http\Controllers\CartController::class, 'cart_update'])->name('cart_update');
	Route::get('/buy_form/{seller}', [App\Http\Controllers\BuyController::class, 'buy_form'])->name('buy_form');
	Route::post('/buy', [App\Http\Controllers\BuyController::class, 'buy'])->name('buy');
	Route::get('/order_history', [App\Http\Controllers\BuyController::class, 'order_history'])->name('order_history');
	Route::post('/watch',[App\Http\Controllers\WatchListController::class, 'watch'])->name('watch');
	Route::get('/watch_list', [App\Http\Controllers\ProductController::class, 'watch_list'])->name('watch_list');



});
Route::middleware(['auth', 'seller'])->group(function () {
	//  販売者以外見られたくないルート設定
	Route::get('/seller_index', function () {
		return view('seller/seller_index');
	})->name('seller_index');
	Route::get('/product_register', [App\Http\Controllers\ProductCategoryController::class, 'index'])->name('product_register_form');
	Route::get('/kind_register', [\App\Http\Controllers\KindController::class, 'kind_add'])->name('kind_add');
	Route::post('/kind_register', [App\Http\Controllers\ProductController::class, 'product_register'])->name('product_register');
	Route::get('/product_list', [App\Http\Controllers\ProductController::class, 'product_list'])->name('product_list');
	Route::post('/product_list', [App\Http\Controllers\KindController::class, 'kind_register'])->name('kind_register');
	Route::get('/product_detail/{product_id}', [App\Http\Controllers\ProductController::class, 'product_detail'])->name('product_detail');
	Route::post('/product_edit', [App\Http\Controllers\ProductController::class, 'product_edit'])->name('product_edit');
	Route::get('/product_delete/{product_id}', [App\Http\Controllers\ProductController::class, 'product_delete'])->name('product_delete');
	Route::get('/kind_list/{product_id}', [App\Http\Controllers\KindController::class, 'kind_list'])->name('kind_list');
	Route::get('/kind_detail/{kind_id}', [App\Http\Controllers\KindController::class, 'kind_detail'])->name('kind_detail');
	Route::post('/kind_edit', [App\Http\Controllers\KindController::class, 'kind_edit'])->name('kind_edit');
	Route::get('/kind_delete/{kind_id}', [App\Http\Controllers\KindController::class, 'kind_delete'])->name('kind_delete');

});
Route::middleware(['auth', 'admin'])->group(function () {
	//  管理者以外見られたくないルート設定
	Route::get('/admin_index', function () {
		return view('admin/admin_index');
	})->name('admin_index');
	Route::get('/category_register', [App\Http\Controllers\ProductCategoryController::class, 'category_form'])->name('category_form');
	Route::post('/category_register', [App\Http\Controllers\ProductCategoryController::class, 'category_register'])->name('category_register');
	Route::post('/category_update', [App\Http\Controllers\ProductCategoryController::class, 'category_update'])->name('category_update');
	Route::get('/category_delete/{category_id}', [App\Http\Controllers\ProductCategoryController::class, 'category_delete'])->name('category_delete');
	Route::get('/seller_request_list', [App\Http\Controllers\UserController::class, 'seller_request_list'])->name('seller_request_list');
	Route::get('/seller_info/{seller_id}', [App\Http\Controllers\UserController::class, 'seller_info'])->name('seller_info');
	Route::get('/seller_update/{seller_id}', [App\Http\Controllers\UserController::class, 'seller_update'])->name('seller_update');
	Route::get('/seller_delete/{seller_id}', [App\Http\Controllers\UserController::class, 'seller_delete'])->name('seller_delete');
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



