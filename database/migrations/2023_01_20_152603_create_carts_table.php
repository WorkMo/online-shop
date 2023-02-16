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
		Schema::create('carts', function (Blueprint $table) {
			$table->uuid('id')->primary()->index()->comment('カートID');
			$table->char('user_id',36)->index()->comment('ユーザーID');
			$table->char('kind_id',36)->index()->comment('商品種類ID');
			$table->integer('cart_quantity')->length(10)->index()->comment('カート個数');
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists('carts');
	}
};
