<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class ReviewCompanyLike extends Model {
	use HasFactory;
	use HasUuids;
	protected $fillable = [
		'user_id',
		'review_company_id',
	];
	// ReviewCompanyと連結
	public function reviewCompany() {
		return $this->belongsTo(ReviewCompany::class);
	}
	// user
	public function user() {
		return $this->belongsTo(User::class);
	}
}
