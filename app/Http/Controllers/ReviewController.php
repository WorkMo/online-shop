<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Review;

class ReviewController extends Controller {
	protected function review_list() {
		return view('user/review_list');
	}
	protected function review_like_list() {
		return view('user/review_like_list');
	}
}
