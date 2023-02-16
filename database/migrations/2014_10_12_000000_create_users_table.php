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
		Schema::create('users', function (Blueprint $table) {
			$table->uuid('id')->primary()->index()->comment('ユーザーID');
			$table->string('user_status', 20)->index()->default('active')->comment('会員ステータス active or deleted');
			$table->string('admin', 20)->index()->default('0')->comment('管理者ステータス 0=管理者ではない or 1=管理者');
			$table->string('seller', 20)->index()->default('0')->comment('販売者ステータス 0=販売者ではない or 1=販売者');
			$table->string('user_name', 50)->index()->comment('氏名');
			$table->string('user_kana', 50)->index()->comment('フリガナ');
			$table->string('post_code', 8)->index()->comment('郵便番号 数字のみ');
			$table->string('prefecture', 4)->index()->comment('都道府県');
			$table->string('municipality')->index()->comment('市区町村番地');
			$table->string('apartment')->nullable($value = true)->index()->comment('マンション名部屋番号');
			$table->string('email')->index()->comment('メールアドレス');
			$table->timestamp('email_verified_at')->nullable();
			$table->string('phone_number', 11)->index()->comment('電話番号');
			$table->date('birthday')->index()->comment('生年月日');
			$table->string('gender', 10)->index()->comment('性別 男性or女性orその他');
			$table->string('nickname', 50)->nullable($value = true)->index()->comment('ニックネーム');
			$table->string('icon')->nullable($value = true)->comment('アイコン画像');
			$table->string('password')->comment('パスワード');
			$table->rememberToken();
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists('users');
	}
};
