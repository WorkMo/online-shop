<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Inquiry;

class InquiryController extends Controller {
	protected function inquiry_list() {
		return view('user/inquiry_list');
	}
	protected function inquiry_like_list() {
		return view('user/inquiry_like_list');
	}
}
