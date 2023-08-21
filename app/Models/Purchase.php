<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Purchase extends Model {
	use HasFactory;
	use HasUuids;
	protected $fillable = [
		'purchased_status',
		'kind_id',
		'purchased_price_with_tax',
		'purchased_tax_rate',
		'purchased_quantity',
		'purchased_date',
		'arrival_date',
		'due_date',
		'payment_date',
	];
	// product（商品）と連結
	public function product() {
		return $this->belongsTo(Product::class);
	}
}
