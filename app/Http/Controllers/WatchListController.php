<?php

namespace App\Http\Controllers;

use App\Models\WatchList;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WatchListController extends Controller
{
	public function watch(Request $request) {
		$user_id = Auth::user()->id; //1.ログインユーザーのid取得
		$product_id = $request->product_id; //2.投稿idの取得
		$already_watched = WatchList::where('user_id', $user_id)->where('product_id', $product_id)->first(); //3.

		if (!$already_watched) { //もしこのユーザーがこの投稿にまだいいねしてなかったら
			$watchList = new WatchList(); //4.Likeクラスのインスタンスを作成
			$watchList->product_id = $product_id; //Likeインスタンスにreview_id,user_idをセット
			$watchList->user_id = $user_id;
			$watchList->save();
		} else { //もしこのユーザーがこの投稿に既にいいねしてたらdelete
			WatchList::where('product_id', $product_id)->where('user_id', $user_id)->delete();
		}
		//5.この投稿の最新の総いいね数を取得
		$watch_lists_count = Product::withCount('watchLists')->findOrFail($product_id)->watch_lists_count;
		$param = [
			'watch_lists_count' => $watch_lists_count,
		];
		return response()->json($param); //6.JSONデータをjQueryに返す
	}
}
