<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Product;
use App\Models\ProductImage;
use App\Models\ProductCategory;
use App\Models\Review;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class ProductController extends Controller {

	// indexページヘ表示
	protected function index() {
		session()->forget('data');
		// $files = Storage::allFiles('public/temp');
		// foreach ($files as $f) {
		// 	$path = Storage::url($f);
		// 	$up_time = Storage::lastModified($f);
		// 	$up_time = date('Y/m/d H:i:s', $up_time);
		// 	$files[$path] = $up_time;
		// }



		$products = Product::with(['kinds' => function ($q) {
			$q->where('kind_status', 'active')
			->where('kind_public', 'public');
		}, 'watchLists'])
			->where('product_status', 'active')
			->where('product_public', 'public')
			->has('kinds')
			->withMin('kinds', 'product_price_with_tax')
			->withMax('kinds', 'product_price_with_tax')
			->orderBy('created_at', 'asc')
			->withCount('watchLists')
			->get();
		foreach ($products as $product) {
			if ($product->product_main_image == null) {
				$product->product_main_image = 'storage/img/l_e_others_501.png';
			} else {
				$file_name = str_replace('storage/', '', $product->product_main_image);
				if (Storage::disk('public')->exists($file_name) == null) {
					$product->product_main_image = 'storage/img/l_e_others_501.png';
				}
			}
		}
		$product_categories = ProductCategory::where('product_category_status', 'active')
			->get();
		return view('user/index', [
			'products' => $products,
			'product_categories' => $product_categories,
		]);
	}

	protected function search(Request $request) {
		$keyword = null;
		$keyword = $request->input('keyword');
		session()->forget('data');
		$products = Product::with(['kinds' => function ($q) {
			$q->where('kind_status', 'active')->where('kind_public', 'public');
		}, 'watchLists'])
			->where('product_status', 'active')
			->where('product_public', 'public')
			->has('kinds')
			->withMin('kinds', 'product_price_with_tax')
			->withMax('kinds', 'product_price_with_tax')
			->orderBy('created_at', 'asc')
			->withCount('watchLists');
		foreach ($products as $product) {
			if ($product->product_main_image == null) {
				$product->product_main_image = 'storage/img/l_e_others_501.png';
			} else {
				$file_name = str_replace('storage/', '', $product->product_main_image);
				if (Storage::disk('public')->exists($file_name) == null) {
					$product->product_main_image = 'storage/img/l_e_others_501.png';
				}
			}
		}
		$product_categories = ProductCategory::where('product_category_status', 'active')
			->get();
		if ($keyword != null) {

			$products = $products->where('product_keyword', 'like', '%' . $keyword . '%')->get();
			return view('user/index', [
				'products' => $products,
				'product_categories' => $product_categories,
			]);
		} else {
			$products = $products->get();
			return view('user/index', [
				'products' => $products,
				'product_categories' => $product_categories,
			]);
		}
	}


	protected function watch_list() {
		session()->forget('data');

		$products = Product::with(['kinds' => function ($q) {
			$q->where('kind_status', 'active')->where('kind_public', 'public');
		}, 'watchLists'])
			->where('product_status', 'active')
			->where('product_public', 'public')
			->has('kinds')
			->withMin('kinds', 'product_price_with_tax')
			->withMax('kinds', 'product_price_with_tax')
			->orderBy('created_at', 'asc')
			->whereHas('watchLists', function ($q) {
				$q->where('user_id', Auth::user()->id);
			})
			->get();
		foreach ($products as $product) {
			if ($product->product_main_image == null) {
				$product->product_main_image = 'storage/img/l_e_others_501.png';
			} else {
				$file_name = str_replace('storage/', '', $product->product_main_image);
				if (Storage::disk('public')->exists($file_name) == null) {
					$product->product_main_image = 'storage/img/l_e_others_501.png';
				}
			}
		}
		$product_categories = ProductCategory::where('product_category_status', 'active')
			->get();
		return view('user/index', [
			'products' => $products,
			'product_categories' => $product_categories,
		]);
	}

	public function detail($product_id) {
		$product = Product::with(['kinds' => function ($q) {
			$q->where('kind_status', 'active');
		}])
			->where('product_status', 'active')
			->has('kinds')
			->find($product_id);
		$images = ProductImage::select('product_id', 'product_image')
			->where('product_id', $product_id)
			->where('product_image_status', 'active')
			->get();
		$product_images = [];

		if ($product->product_main_image !== '') {
			$product_images[] = $product->product_main_image;
		}

		if ($images !== '') {
			foreach ($images as $image) {
				$product_images[] = $image->product_image;
			}
		}

		$product['image_count'] = count($product_images);
		if ($product['image_count'] > 0) {
			$product['product_images'] = $product_images;
		} else {
			$product['product_images'] = ['storage/img/l_e_others_501.png'];
		}
		$kind_id = [];
		foreach ($product->kinds as $kind) {
			$kind_id[] = $kind->id;
		}
		session()->forget('data');
		session()->put('data', [
			'product_id' => $product->id,
			'kind_id' => $kind_id,
		]);
		$kind_data = [];
		foreach ($product->kinds as $kind) {
			$kind_data[$kind->id] = $kind->product_price_with_tax;
		}

		$reviews=Review::whereHas('buy.kind.product',function($q)use($product_id){
			$q->where('id',$product_id);
		})->get()->sortByDesc('create_at');
		return view('user/detail', ['product' => $product, 'kind_data' => $kind_data,'reviews'=>$reviews]);
	}





	// 登録商品一覧
	protected function product_list() {
		$products = Product::with(['productCategory'], ['kinds' => function ($q) {
			$q->where('kind_status', 'active');
		}])
			->where('product_status', 'active')
			->where('user_id', Auth::user()->id)
			->withCount('kinds')
			->orderBy('created_at', 'asc')
			->get();
		foreach ($products as $product) {
			if ($product->product_main_image == null) {
				$product->product_main_image = 'storage/img/l_e_others_501.png';
			} else {
				$file_name = str_replace('storage/', '', $product->product_main_image);
				if (Storage::disk('public')->exists($file_name) == null) {
					$product->product_main_image = 'storage/img/l_e_others_501.png';
				}
			}
		}
		$column_names = ['商品名', '公開非公開', 'カテゴリー', '種類数', 'レビュー評価', '販売累計数', '詳細', '編集', '削除'];
		$columns = ['product_name', 'product_public', 'productCategory->category_name', "kinds_count", 'review_rating_average', 'total_sales'];
		// $columns = array_splice($columns, 0, -1);


		return view('seller/product_list', [
			'products' => $products,
			'column_names' => $column_names,
			'columns' => $columns,
		]);
	}

	protected function product_form() {
		return view('seller/product_register');
	}

	// 商品登録

	protected function product_register(Request $request) {
		$request_data = $request->all();
		// 画像ファイル一時保存
		if ($request->product_main_image_temp !== null) {
			$session_array = [
				'main_image_name' => session('data.main_image_name'),
				'main_image_path' => session('data.main_image_path'),
			];
		} else if ($request->product_main_image !== null) {
			$time = now();
			$date = date('Y-m-d');
			$id = (Product::count()) + 1;
			$main_image_name = $request->file('product_main_image')->getClientOriginalName();
			$main_image_path = 'storage/temp/' . $date . '/product/' . $id . '/' . $time . '_' . $main_image_name;
			if (mb_strlen($main_image_path) > 255) {
				$request->file('product_main_image')->storeAs('public/temp/' . $date . '/product/' . $id, $time . '_main_image');
				$main_image_path = 'storage/temp/' . $date . '/product/' . $id . '/' . $time . '_main_image';
			} else {
				$request->file('product_main_image')->storeAs('public/temp/' . $date . '/product/' . $id, $time . '_' . $main_image_name);
			}
			$session_array = [
				'main_image_name' => $main_image_name,
				'main_image_path' => $main_image_path,
			];
		}


		if ($request->product_main_image_temp !== null) {
			$session_array = [
				'main_image_name' => session('data.main_image_name'),
				'main_image_path' => session('data.main_image_path'),
			];
		}
		if (preg_grep('/^product_image\d$/', $request_data) !== null) {
			$i = 1;
			while (array_key_exists('product_image' . $i, $request_data)) {
				$time = now();
				$date = date('Y-m-d');
				$id = (Product::count()) + 1;
				$file_name = 'product_image' . $i;
				$image_name = $request->file($file_name)->getClientOriginalName();
				$image_path = 'storage/temp/' . $date . '/product/' . $id . '/' . $i . '_' . $time . '_' . $image_name;
				if (mb_strlen($image_path) > 255) {
					$request->file('product_image' . $i)->storeAs('public/temp/' . $date . '/product/' . $id, $i . '_' . $time . '_product_image');
					$image_path = 'storage/temp/' . $date . '/product/' . $id . '/' . $i . '_' . $time . '_product_image';
				} else {
					$request->file('product_image' . $i)->storeAs('public/temp/' . $date . '/product/' . $id, $i . '_' . $time . '_' . $image_name);
				}
				session()->flash('data', [
					'image_name' . $i => $image_name,
					'image_path' . $i =>  $image_path,
				]);
				$i++;
			}
		}
		session()->forget('data');
		if (isset($session_array)) {
			session()->flash('data', $session_array);
		}


		// バリデーション
		$validate_data = [
			'product_name' => ['required', 'max:255'],
			'product_keyword' => ['nullable', 'max:255'],
			'product_category_id' => ['required', 'max:50'],
			'product_detail' => ['required', 'max:255'],
			'product_main_image' => ['nullable', 'mimes:jpg,jpeg,png,gif'],
			'product_image' => ['nullable', 'mimes:jpg,jpeg,png,gif'],
		];
		if (preg_grep('/^product_image\d$/', $request_data) !== null) {
			$i = 1;
			while (array_key_exists('product_image' . $i, $request_data)) {
				$validate_data['product_image' . $i] = 'nullable|mimes:jpg,jpeg,png,gif|';
				$i++;
			}
		}
		$request->validate($validate_data);
		// Productへ保存
		$save = Product::create([
			'user_id' => Auth::user()->id,
			'product_name' => $request->product_name,
			'product_keyword' => $request->product_keyword,
			'product_category_id' => $request->product_category_id,
			'product_detail' => $request->product_detail,
		]);
		if ($request->product_main_image !== null) {
			$time = now();
			$main_image_name = $time . '_' . $request->file('product_main_image')->getClientOriginalName();
			$id = $save->id;
			$main_image_path = 'storage/product/' . $id . '/' . $main_image_name;
			if (mb_strlen($main_image_path) > 255) {
				$request->file('product_main_image')->storeAs('public/product/' . $id, $time . '_main_image');
				$main_image_path = 'storage/product/' . $id . '/' . $time . '_main_image';
			} else {
				$request->file('product_main_image')->storeAs('public/product/' . $id, $main_image_name);
			}
		} else {
			$main_image_path = '';
		}
		$save->product_main_image = $main_image_path;
		$save->save();

		//ProductImageへ保存

		if (preg_grep('/^product_image\d$/', $request_data) !== null) {
			$i = 1;
			while (array_key_exists('product_image' . $i, $request_data)) {
				$time = now();
				$image_name = $time . '_' . $request->file('product_image' . $i)->getClientOriginalName();
				$id = $save->id;
				$image_path = 'storage/product/' . $id . '/' . $i . $image_name;
				if (mb_strlen($image_path) > 255) {
					$request->file('product_image' . $i)->storeAs('public/product/' . $id, $i . $time . '_product_image');
					$image_path = 'storage/product/' . $id . '/' . $i . $time . '_product_image';
				} else {
					$request->file('product_image' . $i)->storeAs('public/product/' . $id, $i . $image_name);
				}
				ProductImage::create([
					'product_id' => $save->id,
					'product_image' => $image_path,
				]);
				$i++;
			}
		}
		session()->forget('data');
		session()->put('data', [
			'product_id' => $save->id,
		]);
		return view('seller/kind_register', [
			'product_id' => $save->id,
			'product_name'  =>  $save->product_name,
		]);
	}
	protected function product_detail() {
	}
	protected function product_delete($product_id) {
		$product = Product::find($product_id);
		if ($product->user_id == Auth::user()->id) {
			$product->product_status = 'delete';
			$product->save();
			return redirect()->route('product_list');
		} else {
			$message = app()->make('App\Http\Controllers\Controller');
			return
				$message->message_redirect('エラーが発生いたしました。');
		}
	}
}
