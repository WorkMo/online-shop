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
		Schema::create('reply_images', function (Blueprint $table) {
			$table->uuid('id')->primary()->index()->comment('返信画像ID');
			$table->string('reply_image_status', 20)->index()->default('active')->comment('返信画像ステータス active or deleted');
			$table->char('reply_id', 36)->index()->comment('返信ID');
			$table->string('reply_image')->nullable($value = true)->comment('返信画像URL');
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists('reply_images');
	}
};
