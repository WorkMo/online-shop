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
		Schema::create('post_images', function (Blueprint $table) {
			$table->uuid('id')->primary()->index()->comment('投稿画像ID');
			$table->string('post_image_status', 20)->index()->default('active')->comment('投稿画像ステータス active or deleted');
			$table->char('post_id', 36)->index()->comment('投稿ID');
			$table->string('post_image')->nullable($value = true)->comment('投稿画像URL');
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists('post_images');
	}
};
