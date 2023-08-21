<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Buy;
use App\Models\Review;
use App\Models\Product;
use App\Models\ReviewImage;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller {
	protected function review_list() {
		$reviews=Review::with([
			'reviewImages'=>function($q){
			$q->where('review_image_status','active');
			}
		,'buy','buy.kind.product'])->whereHas('buy',function($q){
			$q->where('user_id',Auth::user()->id);
		})->withCount('reviewImages')->get();
		return view('user/review_list',['reviews'=>$reviews]);
	}
	protected function review_like_list() {
		return view('user/review_like_list');
	}
	protected function review_form($request) {
		$buy_data = Buy::find($request);
		if ($buy_data->user_id !== Auth::user()->id) {
			$message = app()->make('App\Http\Controllers\Controller');
			return
				$message->message_redirect('エラーが発生いたしました。');
		}
		session()->forget('data');
		session()->put('data', [
			'buy_id' => $request
		]);
		return view('user/review_register', ['buy_data' => $buy_data]);
	}

	protected function review_register(Request $request) {
		// if ($buy_data->user_id !== Auth::user()->id) {
		// 	$message = app()->make('App\Http\Controllers\Controller');
		// 	return
		// 		$message->message_redirect('エラーが発生いたしました。');
		// }
		$request_data = $request->all();
		// バリデーション
		$validate_data = [
			'review_name' => ['required', 'max:50'],
			'review_rating' => ['required', 'max:1'],
			'review_text' => ['required', 'max:255'],
			'review_image' => ['nullable', 'mimes:jpg,jpeg,png,gif'],
		];
		if (preg_grep('/^review_image\d$/', $request_data) !== null) {
			$i = 1;
			while (array_key_exists('review_image' . $i, $request_data)) {
				$validate_data['review_image' . $i] = 'nullable|mimes:jpg,jpeg,png,gif|';
				$i++;
			}
		}
		$request->validate($validate_data);
		// reviewへ保存
		$save = Review::create([
			'review_name' => $request->review_name,
			'buy_id' => session('data.buy_id'),
			'review_rating' => $request->review_rating,
			'review_text' => $request->review_text,
		]);

		//Imageへ保存

		if (preg_grep('/^review_image\d$/', $request_data) !== null) {
			$i = 1;
			while (array_key_exists('review_image' . $i, $request_data)) {
				$time = now();
				$image_name = $time . '_' . $request->file('review_image' . $i)->getClientOriginalName();
				$id = $save->id;
				$image_path = 'storage/review/' . $id . '/' . $i . $image_name;
				if (mb_strlen($image_path) > 255) {
					$request->file('review_image' . $i)->storeAs('public/review/' . $id, $i . $time . '_review_image');
					$image_path = 'storage/review/' . $id . '/' . $i . $time . '_review_image';
				} else {
					$request->file('review_image' . $i)->storeAs('public/review/' . $id, $i . $image_name);
				}
				ReviewImage::create([
					'review_id' => $save->id,
					'review_image' => $image_path,
				]);
				$i++;
			}
		}
		$product_id = Buy::find(session('data.buy_id'))->kind->product_id;
		$product = Product::find($product_id);
		$review_data = Review::where('review_status', 'active')->whereHas('buy.kind.product', function ($q) use ($product_id) {
			$q->where('id', $product_id);
		});
		$product->review_rating_average = $review_data->avg('review_rating');
		$product->review_rating_number = $review_data->count('id');
		$product->save();
		session()->forget('data');
		return redirect()->route('review_list');
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
