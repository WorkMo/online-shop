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
		Schema::create('buys', function (Blueprint $table) {
			$table->uuid('id')->primary()->index()->comment('売上ID');
			$table->string('bought_status', 20)->index()->default('active')->comment('売上ステータス active or deleted');
			$table->char('user_id', 36)->index()->comment('ユーザーID');
			$table->char('kind_id', 36)->index()->comment('商品種類ID');

			$table->char('invoice_id', 36)->length(11)->index()->comment('請求書番号 例)2023000001');

			$table->string('seller_post_code', 8)->index()->comment('販売時販売者郵便番号 数字のみ');
			$table->string('seller_name')->index()->comment('販売者名');
			$table->string('seller_address', 50)->index()->comment('販売時販売者住所');
			$table->string('seller_email')->index()->comment('購入時販売者メールアドレス');
			$table->string('seller_phone_number', 11)->index()->comment('電話番号');

			$table->string('purchaser_post_code', 8)->index()->comment('購入時ユーザー郵便番号 数字のみ');
			$table->string('purchaser_name', 50)->index()->comment('購入時ユーザー名');
			$table->string('purchaser_address', 50)->index()->comment('販売時購入者住所');
			$table->string('purchaser_email')->index()->comment('購入時ユーザーメールアドレス');
			$table->string('purchaser_phone_number', 11)->index()->comment('電話番号');

			$table->string('bought_main_image')->nullable($value = true)->comment('販売時商品メイン画像URL');
			$table->string('bought_name', 50)->index()->comment('販売時商品名');
			$table->string('bought_category_name')->index()->comment('カテゴリー名');

			$table->string('bought_kind_name', 50)->index()->comment('サイズとか色とか');
			$table->string('bought_barcode', 13)->index()->nullable($value = true)->comment('JANコード');
			$table->string('bought_code', 10)->index()->nullable($value = true)->comment('品番');
			$table->integer('bought_price_with_tax')->length(10)->index()->comment('販売価格 税込');
			$table->string('bought_tax_rate', 10)->index()->default(0)->comment('販売時消費税率');
			$table->integer('bought_quantity')->length(10)->index()->comment('販売数');
			$table->integer('bought_sum_price')->length(10)->index()->comment('販売金額合計');

			$table->string('payment_method', 50)->index()->comment('支払方法');
			$table->date('shipment_date')->index()->nullable($value = true)->comment('発送完了日');
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists('buys');
	}
};
