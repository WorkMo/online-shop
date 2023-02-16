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
		Schema::create('replies', function (Blueprint $table) {
			$table->uuid('id')->primary()->index()->comment('返信ID');
			$table->string('reply_status', 20)->index()->default('active')->comment('返信ステータス active or deleted');
			$table->char('post_id', 36)->index()->comment('投稿ID');
			$table->char('user_id', 36)->index()->comment('ユーザーID');
			$table->string('reply_text')->index()->comment('返信内容');
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists('replies');
	}
};
