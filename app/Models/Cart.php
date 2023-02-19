<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Cart extends Model {
	use HasFactory;
	use HasUuids;
	protected $fillable = [
		'user_id',
		'kind_id',
		'cart_quantity',
	];

	// user（ユーザー）と連結
	public function user() {
		return $this->belongsTo(User::class);
	}

	// product（商品）と連結
	public function kind() {
		return $this->belongsTo(kind::class);
	}
}
