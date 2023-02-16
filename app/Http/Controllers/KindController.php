<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Kind;
use Illuminate\Validation\Rule;

class KindController extends Controller {
	protected function index() {
		return view('seller/kind_register');
	}
	protected function kind_register(Request $request) {
		$request->validate([
			'kind_name' => ['required', 'max:50', Rule::unique('kinds')->where('kind_status', 'active')->where('product_id', session('data.product_id'))],
			'barcode' => ['nullable', 'between:8,13', 'regex:/^[0-9]+$/i'],
			'code' => ['nullable', 'max:10', 'regex:/^[0-9]+$/i'],
			'product_price_with_tax' => ['required', 'max:11', 'regex:/^[0-9]+$/i'],
			'product_tax_rate' => ['required', 'max:10'],
			'stock_quantity' => ['nullable', 'max:11', 'regex:/^[0-9]+$/i'],
			'ordering_point' => ['nullable', 'max:11', 'regex:/^[0-9]+$/i'],
		]);
		kind::create([
			'product_id' => session('data.product_id'),
			'kind_name' => $request->kind_name,
			'barcode' => $request->barcode,
			'code' => $request->code,
			'product_price_with_tax' => $request->product_price_with_tax,
			'product_tax_rate' => $request->product_tax_rate,
			'stock_quantity' => $request->stock_quantity,
			'ordering_point' => $request->ordering_point,
		]);
		return redirect(route('product_list'));
	}
}
