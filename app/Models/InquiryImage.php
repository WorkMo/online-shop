<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class InquiryImage extends Model {
	use HasFactory;
	use HasUuids;
	protected $fillable = [
		'inquiry_image_status',
		'inquiry_id',
		'inquiry_image',
	];
	// inquiryと連結
	public function inquiry() {
		return $this->belongsTo(Inquiry::class);
	}
}
