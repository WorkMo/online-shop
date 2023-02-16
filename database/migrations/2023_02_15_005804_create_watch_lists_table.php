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
		Schema::create('watch_lists', function (Blueprint $table) {
			$table->uuid('id')->primary()->index()->comment('ウォッチリストID');
			$table->string('watch_lists_status', 20)->index()->default('active')->comment('ウォッチリストステータス active or deleted');
			$table->char('user_id', 36)->index()->comment('ユーザーID');
			$table->char('product_id', 36)->index()->comment('商品ID');
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists('watch_lists');
	}
};
