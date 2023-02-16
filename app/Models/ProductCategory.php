<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class ProductCategory extends Model {
	use HasFactory;
	use HasUuids;
	protected $fillable = [
		'product_category_status',
		'category_name',
	];

	// product（商品）と連結
	public function products() {
		return $this->hasMany(Product::class);
	}
}
