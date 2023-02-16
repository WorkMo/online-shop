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
		Schema::create('product_categories', function (Blueprint $table) {
			$table->uuid('id')->primary()->index()->comment('商品カテゴリーID');
			$table->string('product_category_status', 20)->index()->default('active')->comment('商品カテゴリーステータス active or deleted');
			$table->string('category_name')->index()->comment('カテゴリー名');
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists('product_categories');
	}
};
