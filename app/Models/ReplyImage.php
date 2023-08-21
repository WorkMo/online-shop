<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class ReplyImage extends Model {
	use HasFactory;
	use HasUuids;
	protected $fillable = [
		'reply_image_status',
		'reply_id',
		'reply_image',
	];
	// Replyと連結
	public function reply() {
		return $this->belongsTo(Reply::class);
	}
}
