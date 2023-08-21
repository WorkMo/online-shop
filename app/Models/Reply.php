<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Reply extends Model {
	use HasFactory;
	use HasUuids;
	protected $fillable = [
		'reply_status',
		'post_id',
		'user_id',
		'reply_text',
	];
	public function post() {
		return $this->belongsTo(Post::class);
	}
	public function user() {
		return $this->belongsTo(User::class);
	}
	// ReplyImageと連結
	public function replyImages() {
		return $this->hasMany(ReplyImage::class);
	}
	// ReplyLikeと連結
	public function replyLikes() {
		return $this->hasMany(ReplyLike::class);
	}
}
