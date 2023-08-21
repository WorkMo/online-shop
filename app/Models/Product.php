<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Product extends Model {
	use HasFactory;
	use HasUuids;
	protected $fillable = [
		'user_id',
		'product_status',
		'product_public',
		'product_name',
		'product_keyword',
		'product_category_id',
		'product_detail',
		'product_main_image',
		'review_rating_average',
		'review_rating_number',
		'total_sales',
	];

	// user(ユーザー)と連結
	public function user() {
		return $this->belongsTo(User::class);
	}
	// productImage(商品画像)と連結
	public function productImages() {
		return $this->hasMany(ProductImage::class);
	}

	// productCategory(商品カテゴリー)と連結
	public function productCategory() {
		return $this->belongsTo(ProductCategory::class);
	}

	// kind(商品種類)と連結
	public function kinds() {
		return $this->hasMany(Kind::class);
	}
	// Inquiryと連結
	public function inquiries() {
		return $this->hasMany(Inquiry::class);
	}

	// purchase(仕入)と連結
	public function purchases() {
		return $this->hasMany(Purchase::class);
	}
	// watchList(お気に入り)と連結
	public function watchLists() {
		return $this->hasMany(WatchList::class);
	}



	// cart(カート)と連結
	public function carts() {
		return $this->hasMany(Cart::class);
	}

	// review(レビュー)と連結
	public function reviews() {
		return $this->hasMany(Review::class);
	}





	public function is_watch($user): bool {
		return WatchList::where('user_id', $user->id)->where('product_id', $this->id)->first() !== null;
	}
}
