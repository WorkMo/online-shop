<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Buy extends Model {
	use HasFactory;
	use HasUuids;
	protected $fillable = [];

	// user（ユーザー）と連結
	public function user() {
		return $this->belongsTo(User::class);
	}

	// product（商品）と連結
	public function product() {
		return $this->belongsTo(Product::class);
	}

	// review(レビュー)と連結
	public function review() {
		return $this->hasOne(Review::class);
	}
}
