<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Cart;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller {
	protected function cart() {
		$carts = Cart::with('kind' ,'kind.product','kind.product.user')
		->where('user_id', Auth::user()->id);
			$carts=$carts->whereHas('kind',function($q){
				$q->where('kind_status','active')->where('kind_public','public');
			})->whereHas('kind.product',function($q){
				$q->where('product_status','active')->where('product_public','public');
			})->whereHas('kind.product.user', function ($q) {
			$q->where('user_status', 'active');
		})->get();
		foreach ($carts as $cart) {
			if ($cart->kind->product->product_main_image == null) {
				$cart->kind->product->product_main_image = 'storage/img/l_e_others_501.png';
			} else {
				$file_name = str_replace('storage/', '', $cart->kind->product->product_main_image);

				if (Storage::disk('public')->exists($file_name) == null) {
					$cart->kind->product->product_main_image = 'storage/img/l_e_others_501.png';
				}
			}
		}
		$carts = $carts->groupBy('kind.product.user_id')->toArray();
		$sum = [];
		foreach ($carts as $cart_shops) {
			$sum_array = [];
			foreach ($cart_shops as $cart_shop) {
				$sum_array[] = $cart_shop['kind']['product_price_with_tax'] * $cart_shop['cart_quantity'];
			}
			$sum[$cart_shops['0']['kind']['product']['user']['user_name']] = array_sum($sum_array);
		}
		return view('user/cart', ['carts' => $carts, 'sum' => $sum]);
	}

	protected function cart_add(Request $request) {
		if (!in_array($request->kind_id, session('data.kind_id'))) {
			$message = app()->make('App\Http\Controllers\Controller');
			return
				$message->message_redirect('エラーが発生いたしました。');
		};
		$request->validate([
			'kind_id' => ['required', 'max:36', Rule::exists('kinds', 'id')->where('kind_status', 'active')->where('product_id', session('data.product_id'))],
			'cart_quantity' => ['nullable', 'max:11', 'regex:/^[0-9]+$/'],
		]);
		$carted = Cart::where('user_id', Auth::user()->id)->where('kind_id', $request->kind_id)->exists();
		if ($carted) {
			$carted_item = Cart::where('user_id', Auth::user()->id)->where('kind_id', $request->kind_id)->first();
			$sum_quantity = $carted_item->cart_quantity + $request->cart_quantity;
			$update_item = Cart::find($carted_item->id);
			$update_item->cart_quantity = $sum_quantity;
			$update_item->save();
			return redirect(route('cart'));;
		} else {
			Cart::create([
				'user_id' => Auth::user()->id,
				'kind_id' => $request->kind_id,
				'cart_quantity' => $request->cart_quantity,
			]);
			return redirect(route('cart'));;
		}
	}

	protected function cart_update(Request $request) {
		$request->validate([
			'cart_quantity' => ['nullable', 'max:11', 'regex:/^[0-9]+$/'],
			'update' => ['required', Rule::exists('carts', 'id')->where('user_id', Auth::user()->id)]
		]);
		$carted = Cart::where('user_id', Auth::user()->id)->where('id', $request->update)->exists();
		if ($carted) {
			$update_item = Cart::find($request->update);
			$update_item->cart_quantity = $request->cart_quantity;
			$update_item->save();
			return redirect(route('cart'));
		} else {
			$message = app()->make('App\Http\Controllers\Controller');
			return
				$message->message_redirect('エラーが発生いたしました。');
		}
	}

	protected function cart_delete($cart_id) {
		$contact = Cart::find($cart_id);
		if (Auth::user()->id !== $contact->user_id) {
			$message = app()->make('App\Http\Controllers\Controller');
			return
				$message->message_redirect('エラーが発生いたしました。');
		};
		$contact = Cart::find($cart_id);
		$contact->delete();
		return redirect(route('cart'));
	}
}
