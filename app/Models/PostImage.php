<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class PostImage extends Model {
	use HasFactory;
	use HasUuids;
	protected $fillable = [
		'post_image_status',
		'post_id',
		'post_image',
	];
	// Postと連結
	public function post() {
		return $this->belongsTo(Post::class);
	}
}
