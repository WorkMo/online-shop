<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Inquiry extends Model {
	use HasFactory;
	use HasUuids;
	protected $fillable = [
		'inquiry_status',
		'inquiry_public',
		'product_id',
		'user_id',
		'inquiry_text',
	];
	// product（商品）と連結
	public function product() {
		return $this->belongsTo(Product::class);
	}
	// user（ユーザー）と連結
	public function user() {
		return $this->belongsTo(User::class);
	}
	// Answerと連結
	public function answers() {
		return $this->hasMany(Answer::class);
	}
	// InquiryImageと連結
	public function inquiryImages() {
		return $this->hasMany(InquiryImage::class);
	}
	// InquiryLikeと連結
	public function inquiryLikes() {
		return $this->hasMany(InquiryLike::class);
	}
}
