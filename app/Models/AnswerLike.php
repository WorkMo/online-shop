<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class AnswerLike extends Model {
	use HasFactory;
	use HasUuids;
	protected $fillable = [
		'user_id',
		'answer_id',
	];

	// Answerと連結
	public function answer() {
		return $this->belongsTo(Answer::class);
	}
	// user
	public function user() {
		return $this->belongsTo(User::class);
	}

}
