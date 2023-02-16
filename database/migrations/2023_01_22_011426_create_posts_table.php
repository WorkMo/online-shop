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
		Schema::create('posts', function (Blueprint $table) {
			$table->uuid('id')->primary()->index()->comment('投稿ID');
			$table->string('post_status', 20)->index()->default('active')->comment('投稿ステータス active or deleted');
			$table->char('user_id', 36)->index()->comment('ユーザーID');
			$table->string('post_text')->index()->comment('投稿内容');
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists('posts');
	}
};
