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
		Schema::create('answers', function (Blueprint $table) {
			$table->uuid('id')->primary()->index()->comment('回答ID');
			$table->string('answer_status', 20)->index()->default('active')->comment('回答ステータス active or deleted');
			$table->char('inquiry_id', 36)->index()->comment('質問ID');
			$table->char('user_id', 36)->index()->comment('ユーザーID');
			$table->string('answer_text')->index()->comment('回答内容');
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists('answers');
	}
};
