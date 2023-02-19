<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Buy;
use App\Models\Cart;
use App\Models\Kind;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Stripe\Stripe;
use Stripe\Charge;
use Illuminate\Validation\Rule;
use App\Rules\PhoneNumber;
use Laravel\Cashier\Cashier;

class BuyController extends Controller {
	protected function buy_form($seller) {
		$buys = Cart::with(['kind' => function ($q) {
			$q->where('kind_status', 'active')->whereHas('product');
		}, 'kind.product' => function ($q) {
			$q->where('product_status', 'active');
		}, 'kind.product.user' => function ($q) {
			$q->where('user_status', 'active');
		}])
			->where('user_id', Auth::user()->id)
			->whereHas('kind.product.user', function ($q) use ($seller) {
				$q->whereExists(function ($q) use ($seller) {
					$q->where('id', $seller);
				});
			});
		$carted = $buys->exists();
		$buys = $buys->get();
		if ($carted) {
			foreach ($buys as $buy) {
				if ($buy->kind->product->product_main_image == null) {
					$buy->kind->product->product_main_image = 'storage/img/l_e_others_501.png';
				} else {
					$file_name = str_replace('storage/', '', $buy->kind->product->product_main_image);

					if (Storage::disk('public')->exists($file_name) == null) {
						$buy->kind->product->product_main_image = 'storage/img/l_e_others_501.png';
					}
				}
			}
			$sum = [];
			$sum_array = [];
			foreach ($buys as $buy) {
				$sum_array[] = $buy->kind->product_price_with_tax * $buy->cart_quantity;
			}
			$sum = array_sum($sum_array);
			session()->forget('data');
			session()->put('data', [
				'buys' => $buys,
				'sum' => $sum,
			]);
			return view('user/buy');
		} else {
			$message = app()->make('App\Http\Controllers\Controller');
			return
				$message->message_redirect('エラーが発生いたしました。');
		}
	}





	protected function buy(Request $request) {

		$request->validate([
			'user_name' => ['required', 'string', 'max:50'],
			'post_code' => ['required', 'regex:/^\d{3}-\d{4}$/'],
			'prefecture' => ['required', 'string', 'max:4'],
			'municipality' => ['required', 'string', 'max:255'],
			'apartment' => ['nullable', 'string', 'max:255'],
			'email' => ['required', 'string', 'email', 'max:255', Rule::exists('users')->where('user_status', 'active'),],
			'phone_number' => ['required', new PhoneNumber],
			'payment_method' => ['required', 'max:10'],
		]);
		$num = Buy::where('user_id', Auth::user()->id)->count() + 1;
		$invoice_id = date('Y') . str_pad($num, 6, 0, STR_PAD_LEFT);
		if ($request->payment_method == '現金') {
			$prefecture = $request->prefecture;
			$municipality = $request->municipality;
			$apartment = $request->apartment;
			$purchaser_address = $prefecture . $municipality . $apartment;
			foreach (session('data.buys') as $buy_item) {
				$prefecture = $buy_item->kind->product->user->prefecture;
				$municipality = $buy_item->kind->product->user->municipality;
				$apartment = $buy_item->kind->product->user->apartment;
				$seller_address = $prefecture . $municipality . $apartment;

				Buy::create([
					'user_id' => Auth::user()->id,
					'invoice_id' => $invoice_id,
					'kind_id' => $buy_item->kind->id,
					'seller_name' => $buy_item->kind->product->user->user_name,
					'seller_post_code' => $buy_item->kind->product->user->post_code,
					'seller_address' => $seller_address,
					'purchaser_post_code' => $request->post_code,
					'purchaser_name' => $request->user_name,
					'purchaser_address' => $purchaser_address,
					'purchaser_email' => $request->email,
					'purchaser_phone_number' => $request->phone_number,
					'purchased_main_image' => $buy_item->kind->product->product_main_image,
					'purchased_name' => $buy_item->kind->product->product_name,
					'bought_price_with_tax' => $buy_item->kind->product_price_with_tax,
					'bought_tax_rate' => $buy_item->kind->product_tax_rate,
					'bought_quantity' => $buy_item->cart_quantity,
					'payment_method' => $request->payment_method,
				]);
				$contact = Cart::find($buy_item->id);
				$contact->delete();
				$kind = Kind::find($buy_item->kind->id);
				if ($kind->bought_quantity > 0) {
					$kind->bought_quantity = $kind->bought_quantity - $buy_item->cart_quantity;
					if ($kind->bought_quantity >= 0) {
						$kind->bought_quantity->save();
					} else {
						$kind->bought_quantity = 0;
						$kind->bought_quantity->save();
					}
				}
			}
			$message = app()->make('App\Http\Controllers\Controller');
			return
				$message->message_redirect('注文が完了いたしました。');
		} elseif ($request->payment_method == 'クレジット') {
			session()->put('data', [
				'buys' => session('data.buys'),
				'sum' => session('data.sum'),
				'request' => $request->all(),
			]);
			return view('user/card_pay');
		}
	}






	protected function order_history() {
		$order_histories = Buy::with(['user', 'kind'])->whereHas('user', function ($q) {
			$q->where('user_id', Auth::user()->id);
		})->get()->groupBy('invoice_id');
		dd($order_histories);
		return view('user/order_history', ['order_histories' => $order_histories]);
	}
}
