<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class ReplyLike extends Model {
	use HasFactory;
	use HasUuids;
	protected $fillable = [
		'user_id',
		'reply_id',
	];
	// Replyと連結
	public function reply() {
		return $this->belongsTo(Reply::class);
	}
	// user
	public function user() {
		return $this->belongsTo(User::class);
	}
}
