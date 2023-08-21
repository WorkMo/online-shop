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
		Schema::create('review_likes', function (Blueprint $table) {
			$table->uuid('id')->primary()->index()->comment('レビューいいねID');
			$table->char('user_id', 36)->index()->comment('いいねしたユーザーID');
			$table->char('review_id', 36)->index()->comment('いいねされたレビューID');
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists('review_likes');
	}
};
