<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Laravel\Cashier\Billable;

class User extends Authenticatable {
	use HasApiTokens, HasFactory, Notifiable, HasUuids, Billable;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array<int, string>
	 */
	protected $fillable = [
		'user_status',
		'admin',
		'seller',
		'user_name',
		'user_kana',
		'post_code',
		'prefecture',
		'municipality',
		'apartment',
		'email',
		'email_verified_at',
		'phone_number',
		'birthday',
		'gender',
		'nickname',
		'icon',
		'password',
	];

	/**
	 * The attributes that should be hidden for serialization.
	 *
	 * @var array<int, string>
	 */
	protected $hidden = [
		'password',
		'remember_token',
	];

	/**
	 * The attributes that should be cast.
	 *
	 * @var array<string, string>
	 */
	protected $casts = [
		'email_verified_at' => 'datetime',
	];

	// company(会社)と連結
	public function company() {
		return $this->hasOne(Company::class);
	}

	// Buy(売上)と連結
	public function buys() {
		return $this->hasMany(Buy::class);
	}

	// cart(カート)と連結
	public function carts() {
		return $this->hasMany(Cart::class);
	}

	// Product(商品)と連結
	public function Products() {
		return $this->hasMany(Product::class);
	}
	// watchList(お気に入り)と連結
	public function watchLists() {
		return $this->hasMany(WatchList::class);
	}

	// answerと連結
	public function answers() {
		return $this->hasMany(Answer::class);
	}
	// answerと連結
	public function answerLikes() {
		return $this->hasMany(AnswerLike::class);
	}

	// inquiry(質問)と連結
	public function inquiries() {
		return $this->hasMany(Inquiry::class);
	}
	// inquiryLikeと連結
	public function inquiryLikes() {
		return $this->hasMany(InquiryLike::class);
	}

	// postと連結
	public function posts() {
		return $this->hasMany(Post::class);
	}
	// postLikeと連結
	public function postLikes() {
		return $this->hasMany(PostLike::class);
	}

	// replyLikeと連結
	public function replies() {
		return $this->hasMany(Reply::class);
	}
	// replyLikeと連結
	public function replyLikes() {
		return $this->hasMany(ReplyLike::class);
	}
	// reviewLikeと連結
	public function reviewLikes() {
		return $this->hasMany(ReviewLike::class);
	}
	// reviewCompanyLikeと連結
	public function reviewCompanyLikes() {
		return $this->hasMany(ReviewCompanyLike::class);
	}
}
