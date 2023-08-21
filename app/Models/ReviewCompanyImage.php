<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class ReviewCompanyImage extends Model {
	use HasFactory;
	use HasUuids;
	protected $fillable = [
		'review_company_image_status',
		'review_company_id',
		'review_company_image',
	];
	// ReviewCompanyと連結
	public function reviewCompany() {
		return $this->belongsTo(ReviewCompany::class);
	}
}
