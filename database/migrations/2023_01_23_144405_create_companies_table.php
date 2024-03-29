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
		Schema::create('companies', function (Blueprint $table) {
			$table->uuid('id')->primary()->index()->comment('会社ID');
			$table->char('user_id', 36)->index()->comment('登録ユーザーID');
			$table->string('company_status', 20)->index()->default('active')->comment('会社ステータス active or deleted');
			$table->string('company_detail')->index()->comment('会社概要');
			$table->string('company_icon')->nullable($value = true)->comment('会社メイン画像URL');
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists('companies');
	}
};
