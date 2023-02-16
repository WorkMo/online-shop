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
		Schema::create('kinds', function (Blueprint $table) {
			$table->uuid('id')->primary()->index()->comment('種類ID');
			$table->string('kind_status', 20)->index()->default('active')->comment('種類ステータス active or deleted');
			$table->string('kind_public', 20)->index()->default('public')->comment('商品公開 public or private');
			$table->char('product_id',36)->index()->comment('商品ID');
			$table->string('kind_name', 50)->index()->comment('サイズとか色とか');
			$table->string('barcode', 13)->index()->nullable($value = true)->comment('JANコード');
			$table->string('code', 10)->index()->nullable($value = true)->comment('品番');
			$table->integer('product_price_with_tax')->length(10)->index()->default(0)->comment('商品販売価格 税込');
			$table->string('product_tax_rate', 10)->index()->default(0)->comment('消費税率');
			$table->integer('stock_quantity')->length(10)->nullable($value = true)->default(0)->comment('在庫数');
			$table->integer('ordering_point')->length(10)->nullable($value = true)->default(0)->comment('発注点');
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists('kinds');
	}
};
