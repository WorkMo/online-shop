<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Review extends Model {
	use HasFactory;
	use HasUuids;
	protected $fillable = [
		'review_status',
		'review_name',
		'buy_id',
		'review_rating',
		'review_text',
	];

	// ReviewImageと連結
	public function reviewImages() {
		return $this->hasMany(ReviewImage::class);
	}
	// ReviewLikeと連結
	public function reviewLikes() {
		return $this->hasMany(ReviewLike::class);
	}

	// buy（購入）と連結
	public function buy() {
		return $this->belongsTo(Buy::class);
	}
}
