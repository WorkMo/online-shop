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
		Schema::create('products', function (Blueprint $table) {
			$table->uuid('id')->primary()->index()->comment('商品ID');
			$table->char('user_id',36)->index()->comment('登録ユーザーID');
			$table->string('product_status', 20)->index()->default('active')->comment('商品ステータス active or deleted');
			$table->string('product_public', 20)->index()->default('public')->comment('商品公開 public or private');
			$table->string('product_name')->index()->comment('商品名');
			$table->string('product_keyword')->nullable($value = true)->index()->comment('商品キーワード');
			$table->char('product_category_id',36)->index()->comment('商品カテゴリーID');
			$table->string('product_detail')->index()->comment('商品説明');
			$table->string('product_main_image')->nullable($value = true)->comment('商品メイン画像URL');
			$table->decimal('review_rating_average',3,2)->nullable($value = true)->index()->comment('レビュー数値評価平均');
			$table->integer('review_rating_number')->nullable($value = true)->index()->comment('レビュー評価件数');
			$table->integer('total_sales')->nullable($value = true)->index()->comment('販売累計数');
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists('products');
	}
};
