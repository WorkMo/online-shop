<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Company extends Model {
	use HasFactory;
	use HasUuids;
	protected $fillable = [
		'user_id',
		'company_status',
		'company_detail',
		'company_icon',
	];
	// user（ユーザー）と連結
	public function user() {
		return $this->belongsTo(User::class);
	}
}
