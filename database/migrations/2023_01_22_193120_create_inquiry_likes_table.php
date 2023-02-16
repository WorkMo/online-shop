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
		Schema::create('inquiry_likes', function (Blueprint $table) {
			$table->uuid('id')->primary()->index()->comment('質問いいねID');
			$table->string('inquiry_likes_status', 20)->index()->default('active')->comment('質問いいねステータス active or deleted');
			$table->char('user_id', 36)->index()->comment('いいねしたユーザーID');
			$table->char('inquiry_id', 36)->index()->comment('いいねされた質問ID');
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists('inquiry_likes');
	}
};
