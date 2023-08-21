<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class InquiryLike extends Model {
	use HasFactory;
	use HasUuids;
	protected $fillable = [
		'user_id',
		'inquiry_id',
	];
	// inquiryと連結
	public function inquiry() {
		return $this->belongsTo(Inquiry::class);
	}
	// user
	public function user() {
		return $this->belongsTo(User::class);
	}
}
