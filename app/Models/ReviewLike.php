<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class ReviewLike extends Model {
	use HasFactory;
	use HasUuids;
	protected $fillable = [
		'user_id',
		'review_id',
	];
	// Reviewと連結
	public function review() {
		return $this->belongsTo(Review::class);
	}
	// user
	public function user() {
		return $this->belongsTo(User::class);
	}
}
