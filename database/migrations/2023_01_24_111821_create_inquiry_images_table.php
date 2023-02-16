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
		Schema::create('inquiry_images', function (Blueprint $table) {
			$table->uuid('id')->primary()->index()->comment('質問画像ID');
			$table->string('inquiry_image_status', 20)->index()->default('active')->comment('質問画像ステータス active or deleted');
			$table->char('inquiry_id', 36)->index()->comment('質問ID');
			$table->string('inquiry_image')->nullable($value = true)->comment('質問画像URL');
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists('inquiry_images');
	}
};
