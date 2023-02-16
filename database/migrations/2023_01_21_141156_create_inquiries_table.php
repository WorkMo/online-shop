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
		Schema::create('inquiries', function (Blueprint $table) {
			$table->uuid('id')->primary()->index()->comment('質問ID');
			$table->string('inquiry_status', 20)->index()->default('active')->comment('質問ステータス active or deleted');
			$table->string('inquiry_public', 20)->index()->default('private')->comment('公開非公開 public or private');
			$table->char('product_id', 36)->index()->comment('商品ID');
			$table->char('user_id', 36)->index()->comment('ユーザーID');
			$table->string('inquiry_text')->index()->comment('質問内容');
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists('inquiries');
	}
};
