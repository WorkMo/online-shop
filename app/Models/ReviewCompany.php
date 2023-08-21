<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class ReviewCompany extends Model {
	use HasFactory;
	use HasUuids;
	protected $fillable = [
		'review_company_status',
		'review_name',
		'buy_id',
		'review_company_rating',
		'review_company_text',
	];

	// ReviewCompanyImageと連結
	public function reviewCompanyImages() {
		return $this->hasMany(ReviewCompanyImage::class);
	}
	// ReviewCompanyLikeと連結
	public function reviewCompanyLikes() {
		return $this->hasMany(ReviewCompanyLike::class);
	}

	// buy（購入）と連結
	public function buy() {
		return $this->belongsTo(Buy::class);
	}
}
