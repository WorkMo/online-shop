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
		Schema::create('answer_likes', function (Blueprint $table) {
			$table->uuid('id')->primary()->index()->comment('回答いいねID');
			$table->char('user_id', 36)->index()->comment('いいねしたユーザーID');
			$table->char('answer_id', 36)->index()->comment('いいねされた回答ID');
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists('answer_likes');
	}
};
