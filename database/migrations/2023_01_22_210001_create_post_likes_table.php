<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('post_likes', function (Blueprint $table) {
			$table->uuid('id')->primary()->index()->comment('投稿いいねID');
			$table->string('post_likes_status', 20)->index()->default('active')->comment('投稿いいねステータス active or deleted');
			$table->char('user_id', 36)->index()->comment('いいねしたユーザーID');
			$table->char('post_id', 36)->index()->comment('いいねされた投稿ID');
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists('post_likes');
	}
};
