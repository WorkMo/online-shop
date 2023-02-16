<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class ProductImage extends Model {
	use HasFactory;
	use HasUuids;
	protected $fillable = [
		'product_image_status',
		'product_id',
		'product_image',
	];

	// product（商品）と連結
	public function product() {
		return $this->belongsTo(Product::class);
	}
}
