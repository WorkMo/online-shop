<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Post;

class PostController extends Controller {
	protected function post_list() {
		return view('user/post_list');
	}
	protected function post_like_list() {
		return view('user/post_like_list');
	}
}
