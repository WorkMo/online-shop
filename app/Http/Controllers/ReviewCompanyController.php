<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ReviewCompany;

class ReviewCompanyController extends Controller
{
	protected function review_company_form() {
		return view('user/review_company_register');
	}
	protected function review_company_register() {
		return view('user/review_company_register');
	}
}
