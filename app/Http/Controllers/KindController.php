<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Kind;
use App\Models\Product;
use Illuminate\Validation\Rule;

use Illuminate\Support\Facades\Auth;

class KindController extends Controller {
	protected function index() {
		return view('seller/kind_register');
	}
	protected function kind_register(Request $request) {
		$request->validate([
			'kind_name' => ['required', 'max:50', Rule::unique('kinds')->where('kind_status', 'active')->where('product_id', session('data.product_id'))],
			'barcode' => ['nullable', 'between:8,13', 'regex:/^[0-9]+$/'],
			'code' => ['nullable', 'max:10', 'regex:/^[0-9]+$/'],
			'product_price_with_tax' => ['required', 'max:11', 'regex:/^[0-9]+$/'],
			'product_tax_rate' => ['required', 'max:10'],
			'stock_quantity' => ['nullable', 'max:11', 'regex:/^[0-9]+$/'],
			'ordering_point' => ['nullable', 'max:11', 'regex:/^[0-9]+$/'],
		]);
		$save = kind::create([
			'product_id' => session('data.product_id'),
			'kind_name' => $request->kind_name,
			'barcode' => $request->barcode,
			'code' => $request->code,
			'product_price_with_tax' => $request->product_price_with_tax,
			'product_tax_rate' => $request->product_tax_rate,
			'stock_quantity' => $request->stock_quantity,
			'ordering_point' => $request->ordering_point,
		]);
		session()->forget('data');
		return redirect(route('kind_list', ['product_id' => $save->product_id]));
	}
	protected function kind_list($product_id) {
		$kinds = Kind::with(['product' => function ($q) {
			$q->where('product_status', 'active');
		}])->where('kind_status', 'active')->where('product_id', $product_id)->has('product', '>', 0);
		$kinds = $kinds->whereHas('product', function ($q) {
			$q->where('user_id', Auth::user()->id);
		});
		$product_check= Product::find($product_id);
		if ($kinds->exists()) {
			$kinds = $kinds->get();
			session()->forget('data');
			session()->put('data', [
				'product_id' => $kinds->first()->product_id,
				'product_name' => $kinds->first()->product->product_name
			]);
			return view('/seller/kind_list', ['kinds' => $kinds]);
		}elseif(count($kinds->get())==0&& $product_check->user_id == Auth::user()->id ){
			session()->forget('data');
			session()->put('data', [
				'product_id' => $product_check->id,
				'product_name' =>$product_check->product_name,
			]);
			return view('/seller/kind_list', ['kinds' => '']);
		} else {
			$message = app()->make('App\Http\Controllers\Controller');
			return
				$message->message_redirect('エラーが発生いたしました。');
		}
	}
	protected function kind_add() {
		return view('/seller/kind_register', ['product_name' => session('data.product_name')]);
	}
	protected function kind_delete($kind_id) {
		$kind = Kind::find($kind_id);
		if ($kind->product_id == session('data.product_id')) {
			$kind->kind_status = 'delete';
			$kind->save();
			return redirect()->route('kind_list',['product_id'=>session('data.product_id')]);
		} else {
			$message = app()->make('App\Http\Controllers\Controller');
			return
				$message->message_redirect('エラーが発生いたしました。');
		}

	}
}
