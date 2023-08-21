<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Post extends Model {
	use HasFactory;
	use HasUuids;
	protected $fillable = [
		'post_status',
		'user_id',
		'post_text',
	];
	// Replyと連結
	public function replies() {
		return $this->hasMany(Reply::class);
	}
	public function user() {
		return $this->belongsTo(User::class);
	}
	// PostImageと連結
	public function postImages() {
		return $this->hasMany(PostImage::class);
	}
	// PostLikeと連結
	public function postLikes() {
		return $this->hasMany(PostLike::class);
	}

}
