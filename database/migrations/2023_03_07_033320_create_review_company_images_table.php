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
        Schema::create('review_company_images', function (Blueprint $table) {
			$table->uuid('id')->primary()->index()->comment('レビュー画像ID');
			$table->string('review_company_image_status', 20)->index()->default('active')->comment('レビュー画像ステータス active or deleted');
			$table->char('review_company_id', 36)->index()->comment('レビューID');
			$table->string('review_company_image')->nullable($value = true)->comment('レビュー画像URL');
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
        Schema::dropIfExists('review_company_images');
    }
};
