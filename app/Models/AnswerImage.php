<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class AnswerImage extends Model {
	use HasFactory;
	use HasUuids;

	protected $fillable = [
		'answer_image_status',
		'answer_id',
		'answer_image',
	];
	// Answerと連結
	public function answer() {
		return $this->belongsTo(Answer::class);
	}
}
