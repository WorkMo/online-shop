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
		'invoice_id',
		'kind_id',
		'seller_name',
		'seller_post_code',
		'seller_address',
		'purchaser_post_code',
		'purchaser_name',
		'purchaser_address',
		'purchaser_email',
		'purchaser_phone_number',
		'purchased_main_image',
		'purchased_name',
		'bought_price_with_tax',
		'bought_tax_rate',
		'bought_quantity',
		'payment_method',
		'shipment_date',
	];

	// user（ユーザー）と連結
	public function user() {
		return $this->belongsTo(User::class);
	}

	// product（商品）と連結
	public function kind() {
		return $this->belongsTo(Kind::class);
	}

	// review(レビュー)と連結
	public function review() {
		return $this->hasOne(Review::class);
	}
}
