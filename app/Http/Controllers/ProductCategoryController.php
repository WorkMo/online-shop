<?php

namespace App\Http\Controllers;

use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;


class ProductCategoryController extends Controller
{
	// indexページヘ表示
	protected function index() {
		$product_categories = ProductCategory::where('product_category_status', 'active')
			->get();
		return view('seller/product_register', [
			'product_categories' => $product_categories
		]);
	}

	protected function category_form(Request $request) {
		$categories = ProductCategory::where('product_category_status', 'active')
			->get();
		return view('admin/category_list',[
			'categories'=> $categories,
		]);
	}

	protected function category_register(Request $request){
		$request->validate([
			'category_name' => ['required', 'max:50', Rule::unique('product_categories')->where('product_category_status', 'active')],
		]);
		ProductCategory::create([
			'category_name' => $request->category_name,
		]);
		return redirect(route('category_form'));
	}

}
