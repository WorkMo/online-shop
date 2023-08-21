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
					'kind_id' => $buy_item->kind->id,
					'invoice_id' => $invoice_id,
					'seller_post_code' => $buy_item->kind->product->user->post_code,
					'seller_name' => $buy_item->kind->product->user->user_name,
					'seller_address' => $seller_address,
					'seller_email' => $buy_item->kind->product->user->email,
					'seller_phone_number' => $buy_item->kind->product->user->phone_number,
					'purchaser_post_code' => $request->post_code,
					'purchaser_name' => $request->user_name,
					'purchaser_address' => $purchaser_address,
					'purchaser_email' => $request->email,
					'purchaser_phone_number' => $request->phone_number,
					'bought_main_image' => $buy_item->kind->product->product_main_image,
					'bought_name' => $buy_item->kind->product->product_name,
					'bought_category_name' => $buy_item->kind->product->productCategory->category_name,
					'bought_kind_name' => $buy_item->kind->kind_name,
					'bought_barcode' => $buy_item->kind->barcode,
					'bought_code' => $buy_item->kind->code,
					'bought_price_with_tax' => $buy_item->kind->product_price_with_tax,
					'bought_tax_rate' => $buy_item->kind->product_tax_rate,
					'bought_quantity' => $buy_item->cart_quantity,
					'bought_sum_price' => $buy_item->kind->product_price_with_tax * $buy_item->cart_quantity,
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
		$order_histories = Buy::with(['user', 'kind','review'])->whereHas('user', function ($q) {
			$q->where('user_id', Auth::user()->id);
		})->get()->groupBy('invoice_id');
		$sum = [];
		foreach ($order_histories as $order_history) {
			$sum_array = [];
			foreach ($order_history as $order_item) {
				$sum_array[] = $order_item->bought_price_with_tax * $order_item->bought_quantity;
			}
			$sum[$order_history->first()->invoice_id] = array_sum($sum_array);
		}
		foreach ($order_histories as $order_history) {
			foreach ($order_history as $order_item) {
				if ($order_item->bought_main_image == null) {
					$order_item->bought_main_image = 'storage/img/l_e_others_501.png';
				} else {
					$file_name = str_replace('storage/', '', $order_item->bought_main_image);

					if (Storage::disk('public')->exists($file_name) == null) {
						$order_item->bought_main_image = 'storage/img/l_e_others_501.png';
					}
				}
			}
		}
		$category_data = Buy::with(['user', 'kind'])->whereHas('user', function ($q) {
			$q->where('user_id', Auth::user()->id);
		})->get();
		$total = $category_data->sum('bought_sum_price');
		$category_percent['group'] = $category_data->groupBy('bought_category_name')->map(function ($q) use ($total) {
			$data['price'] = $q->sum('bought_sum_price');
			$data['count'] = $q->count();
			$data['quantity'] = $q->sum('bought_quantity');
			$data['percent'] = round($q->sum('bought_sum_price') / $total * 100, 2);
			return $data;
		})->sortByDesc('price');
		$category_percent['sum_price'] = $category_data->sum('bought_sum_price');
		$category_percent['sum_quantity'] = $category_data->sum('bought_quantity');
		$category_percent['sum_count'] = $category_data->count();
		$category_percent['color'] = [
			'darkcyan' => 'white',
			'lightyellow' => 'black',
			'coral' => 'white',
			'lavender' => 'black',
			'teal' => 'white',
			'lightgoldenrodyellow' => 'black',
			'tomato' => 'white',
			'lightsteelblue' => 'black',
			'darkslategray' => 'white',
			'lemonchiffon' => 'black',
			'orangered' => 'white',
			'lightslategray' => 'black',
			'darkgreen' => 'white',
			'wheat' => 'black',
			'red' => 'white',
			'slategray' => 'white',
			'green' => 'white',
			'burlywood' => 'black',
			'crimson' => 'white',
			'steelblue' => 'white',
			'forestgreen' => 'white',
			'tan' => 'black',
			'mediumvioletred' => 'white',
			'royalblue' => 'white',
			'seagreen' => 'white',
			'khaki' => 'black',
			'deeppink' => 'white',
			'midnightblue' => 'white',
			'mediumseagreen' => 'black',
			'yellow' => 'black',
			'hotpink' => 'black',
			'navy' => 'white',
			'mediumaquamarine' => 'black',
			'gold' => 'black',
			'palevioletred' => 'white',
			'darkblue' => 'white',
			'darkseagreen' => 'black',
			'orange' => 'black',
			'pink' => 'black',
			'mediumblue' => 'white',
			'aquamarine' => 'black',
			'sandybrown' => 'black',
			'lightpink' => 'black',
			'floralwhite' => 'black',
			'blue' => 'white',
			'palegreen' => 'black',
			'darkorange' => 'black',
			'thistle' => 'black',
			'linen' => 'black',
			'dodgerblue' => 'white',
			'lightgreen' => 'black',
			'goldenrod' => 'black',
			'magenta' => 'white',
			'antiquewhite' => 'black',
			'cornflowerblue' => 'black',
			'springgreen' => 'black',
			'peru' => 'black',
			'fuchsia' => 'white',
			'papayawhip' => 'black',
			'deepskyblue' => 'black',
			'mediumspringgreen' => 'black',
			'darkgoldenrod' => 'black',
			'violet' => 'black',
			'blanchedalmond' => 'black',
			'lightskyblue' => 'black',
			'lawngreen' => 'black',
			'chocolate' => 'black',
			'plum' => 'black',
			'bisque' => 'black',
			'skyblue' => 'black',
			'chartreuse' => 'black',
			'sienna' => 'white',
			'orchid' => 'white',
			'moccasin' => 'black',
			'lightblue' => 'black',
			'greenyellow' => 'black',
			'saddlebrown' => 'white',
			'mediumorchid' => 'white',
			'navajowhite' => 'black',
			'powderblue' => 'black',
			'lime' => 'black',
			'maroon' => 'white',
			'darkorchid' => 'white',
			'peachpuff' => 'black',
			'paleturquoise' => 'black',
			'limegreen' => 'black',
			'darkred' => 'white',
			'darkviolet' => 'white',
			'mistyrose' => 'black',
			'lightcyan' => 'black',
			'yellowgreen' => 'black',
			'brown' => 'white',
			'darkmagenta' => 'white',
			'lavenderblush' => 'black',
			'cyan' => 'black',
			'darkolivegreen' => 'white',
			'firebrick' => 'white',
			'purple' => 'white',
			'seashell' => 'black',
			'aqua' => 'black',
			'olivedrab' => 'white',
			'indianred' => 'white',
			'indigo' => 'white',
			'oldlace' => 'black',
			'turquoise' => 'black',
			'olive' => 'white',
			'rosybrown' => 'white',
			'darkslateblue' => 'white',
			'ivory' => 'black',
			'mediumturquoise' => 'black',
			'darkkhaki' => 'black',
			'darksalmon' => 'black',
			'blueviolet' => 'white',
			'honeydew' => 'black',
			'darkturquoise' => 'black',
			'palegoldenrod' => 'black',
			'lightcoral' => 'black',
			'mediumpurple' => 'white',
			'mintcream' => 'black',
			'lightseagreen' => 'black',
			'cornsilk' => 'black',
			'salmon' => 'white',
			'slateblue' => 'white',
			'azure' => 'black',
			'cadetblue' => 'black',
			'beige' => 'black',
			'lightsalmon' => 'black',
			'mediumslateblue' => 'white',
			'dimgray' => 'white',
			'gray' => 'white',
			'darkgray' => 'white',
			'silver' => 'black',
			'lightgray' => 'black',
			'gainsboro' => 'black',
			'whitesmoke' => 'black',
			'snow' => 'black',
			'ghostwhite' => 'black',
		];
		$category_percent['bg-color'] = array_keys($category_percent['color']);
		return view('user/order_history', ['order_histories' => $order_histories, 'sum' => $sum, 'category_percent' => $category_percent]);
	}
}
