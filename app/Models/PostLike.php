<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class PostLike extends Model {
	use HasFactory;
	use HasUuids;
	protected $fillable = [
		'user_id',
		'post_id',
	];
	// Postと連結
	public function post() {
		return $this->belongsTo(Post::class);
	}
	// user
	public function user() {
		return $this->belongsTo(User::class);
	}
}
