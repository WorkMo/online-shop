<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class PhoneNumber implements Rule {
	/**
	 * Create a new rule instance.
	 *
	 * @return void
	 */
	public function __construct() {
		//
	}

	/**
	 * Determine if the validation rule passes.
	 *
	 * @param  string  $attribute
	 * @param  mixed  $value
	 * @return bool
	 */
	public function passes($attribute, $value) {
		return (preg_match('/^\d{1,4}-\d{1,4}-\d{3,4}$/', $value) && preg_match('/^\d{10,11}$/', str_replace('-', '', $value))) || preg_match('/^\d{10,11}$/', $value);
	}

	/**
	 * Get the validation error message.
	 *
	 * @return string
	 */
	public function message() {
		return ':attributeを正しく入力してください。';
	}
}
