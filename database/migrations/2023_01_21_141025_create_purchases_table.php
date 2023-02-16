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
		Schema::create('purchases', function (Blueprint $table) {
			$table->uuid('id')->primary()->index()->comment('仕入ID');
			$table->string('purchased_status', 20)->index()->default('active')->comment('仕入ステータス active or deleted');
			$table->char('product_id', 36)->index()->comment('商品ID');
			$table->integer('purchased_price_with_tax')->length(10)->index()->default(0)->comment('仕入価格 税込');
			$table->integer('purchased_tax_rate')->length(3)->index()->default(0)->comment('消費税率');
			$table->integer('purchased_quantity')->length(10)->index()->default(0)->comment('仕入数');
			$table->date('purchased_date')->index()->comment('発注日');
			$table->date('arrival_date')->index()->nullable($value = true)->comment('入荷日');
			$table->date('due_date',)->index()->nullable($value = true)->comment('支払期限');
			$table->date('payment_date',)->index()->nullable($value = true)->comment('支払日');
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists('purchases');
	}
};
