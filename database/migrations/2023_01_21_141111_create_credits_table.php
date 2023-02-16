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
		Schema::create('credits', function (Blueprint $table) {
			$table->uuid('id');
			$table->char('user_id', 36)->unique()->index();
			$table->string('stripe_id')->nullable($value = true);
			$table->string('card_brand')->nullable($value = true);
			$table->string('card_last_four')->nullable($value = true);
			$table->timestamp('trial_ends_at')->nullable($value = true);
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists('credits');
	}
};
