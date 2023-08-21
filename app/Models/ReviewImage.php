<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class ReviewImage extends Model {
	use HasFactory;
	use HasUuids;
	protected $fillable = [
		'review_image_status',
		'review_id',
		'review_image',
	];
	// Reviewと連結
	public function review() {
		return $this->belongsTo(Review::class);
	}
}
