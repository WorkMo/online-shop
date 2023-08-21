<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Answer extends Model {
	use HasFactory;
	use HasUuids;


	protected $fillable = [
		'answer_status',
		'inquiry_id',
		'user_id',
		'answer_text',
	];
	// user（ユーザー）と連結
	public function user() {
		return $this->belongsTo(User::class);
	}
	// Inquiryと連結
	public function Inquiry() {
		return $this->belongsTo(Inquiry::class);
	}
	// AnswerImageと連結
	public function answerImages() {
		return $this->hasMany(AnswerImage::class);
	}
	// AnswerLikeと連結
	public function answerLikes() {
		return $this->hasMany(AnswerLike::class);
	}
}
