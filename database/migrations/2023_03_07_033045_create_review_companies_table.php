<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('review_companies', function (Blueprint $table) {
			$table->uuid('id')->primary()->index()->comment('レビューID');
			$table->string('review_company_status', 20)->index()->default('active')->comment('レビューステータス active or deleted');
			$table->string('review_name', 50)->index()->comment('表示名');
			$table->char('buy_id', 36)->index()->comment('売上ID');
			$table->integer('review_company_rating')->length(1)->index()->comment('レビュー数値評価');
			$table->string('review_company_text')->index()->comment('レビュー内容');
			$table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('review_companies');
    }
};
