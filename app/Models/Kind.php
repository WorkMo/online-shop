<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Kind extends Model {
	use HasFactory;
	use HasUuids;
	protected $fillable = [
		'kind_status',
		'product_id',
		'kind_name',
		'barcode',
		'code',
		'product_price_with_tax',
		'product_tax_rate',
		'stock_quantity',
		'ordering_point',
	];

	// product（商品）と連結
	public function product() {
		return $this->belongsTo(Product::class);
	}
	// Buy(売上)と連結
	public function buys() {
		return $this->hasMany(Buy::class);
	}
}
