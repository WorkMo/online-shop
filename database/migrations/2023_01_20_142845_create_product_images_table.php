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
		Schema::create('product_images', function (Blueprint $table) {
			$table->uuid('id')->primary()->index()->comment('商品画像ID');
			$table->string('product_image_status', 20)->index()->default('active')->comment('商品画像ステータス active or deleted');
			$table->char('product_id',36)->index()->comment('商品ID');
			$table->string('product_image')->nullable($value = true)->comment('レビュー画像URL');
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists('product_images');
	}
};
