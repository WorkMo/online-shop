<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;


class Buy extends Model {
	use HasFactory;
	use HasUuids;
	protected $fillable = [
		'bought_status',
		'user_id',
		'kind_id',
		'invoice_id',
		'seller_post_code',
		'seller_name',
		'seller_address',
		'seller_email',
		'seller_phone_number',
		'purchaser_post_code',
		'purchaser_name',
		'purchaser_address',
		'purchaser_email',
		'purchaser_phone_number',
		'bought_main_image',
		'bought_name',
		'bought_category_name',
		'bought_kind_name',
		'bought_barcode',
		'bought_code',
		'bought_price_with_tax',
		'bought_tax_rate',
		'bought_quantity',
		'bought_sum_price',
		'payment_method',
		'shipment_date',
	];

	// user（ユーザー）と連結
	public function user() {
		return $this->belongsTo(User::class);
	}

	// kind（商品種類）と連結
	public function kind() {
		return $this->belongsTo(Kind::class);
	}

	// review(レビュー)と連結
	public function review() {
		return $this->hasOne(Review::class);
	}
	// review(レビュー)と連結
	public function reviewCompany() {
		return $this->hasOne(ReviewCompany::class);
	}
}
