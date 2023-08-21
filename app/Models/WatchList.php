<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class WatchList extends Model {
	use HasFactory;
	use HasUuids;
	protected $fillable = [
		'user_id',
		'product_id',
	];


	// product（商品）と連結
	public function product() {
		return $this->belongsTo(Product::class);
	}
	// user
	public function user() {
		return $this->belongsTo(User::class);
	}
}
