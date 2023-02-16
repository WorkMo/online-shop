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
		Schema::create('answer_images', function (Blueprint $table) {
			$table->uuid('id')->primary()->index()->comment('回答画像ID');
			$table->string('answer_image_status', 20)->index()->default('active')->comment('回答画像ステータス active or deleted');
			$table->char('answer_id', 36)->index()->comment('回答ID');
			$table->string('answer_image')->nullable($value = true)->comment('回答画像URL');
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists('answer_images');
	}
};
