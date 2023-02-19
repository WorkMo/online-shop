@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
	<div class="col-md-9">
		<div class="card">
			<div class="card-header">ご注文手続き</div>
			<div class="card-body p-4 ">
				<form method="POST" action="{{route('buy')}}">
					@csrf

					<div class="row mb-3">
						<label for="user_name" class="col-md-4 col-form-label text-md-end">お名前 <span class="badge rounded-pill bg-danger">必須</span></label>
						<div class="col-md-6">
							<input id="user_name" type="text" class="form-control @error('user_name') is-invalid @enderror" name="user_name" value="{{ old('user_name',Auth::user()->user_name) }}" placeholder="山田 太郎" required autocomplete="name" autofocus>
							@error('user_name')
							<span class="invalid-feedback" role="alert">
								<strong>{{ $message }}</strong>
							</span>
							@enderror
						</div>
					</div>
					<div class="row mb-3">
						<label for="post_code" class="col-md-4 col-form-label text-md-end">郵便番号 <span class="badge rounded-pill bg-danger">必須</span></label>
						<div class="col-md-6">
							<input id="post_code" type="text" class="form-control @error('post_code') is-invalid @enderror" name="post_code" value="{{ old('post_code',Auth::user()->post_code) }}" placeholder="123-4567" required autocomplete="postal-code" autofocus>
							@error('post_code')
							<span class="invalid-feedback" role="alert">
								<strong>{{ $message }}</strong>
							</span>
							@enderror
						</div>
					</div>
					<div class="row mb-3">
						<label for="prefecture" class="col-md-4 col-form-label text-md-end">都道府県 <span class="badge rounded-pill bg-danger">必須</span></label>
						<div class="col-md-6">
							<select input id="prefecture" class="form-select @error('prefecture') is-invalid @enderror" name="prefecture" required autocomplete="address-level1" autofocus>
								<option hidden value="{{ old('prefecture',Auth::user()->prefecture) }}">{{ old('prefecture',Auth::user()->prefecture) }}</option>
								@foreach(config('prefecture') as $key => $value)
								<option value="{{ $value }}">{{ $value }}</option>
								@endforeach
							</select>
							@error('prefecture')
							<span class="invalid-feedback" role="alert">
								<strong>{{ $message }}</strong>
							</span>
							@enderror
						</div>
					</div>
					<div class="row mb-3">
						<label for="municipality" class="col-md-4 col-form-label text-md-end">市区町村番地 <span class="badge rounded-pill bg-danger">必須</span></label>
						<div class="col-md-6">
							<input id="municipality" type="text" class="form-control @error('municipality') is-invalid @enderror" name="municipality" value="{{ old('municipality',Auth::user()->municipality) }}" placeholder="〇〇市〇〇町〇〇番〇〇" required autocomplete="address-level2" autofocus>
							@error('municipality')
							<span class="invalid-feedback" role="alert">
								<strong>{{ $message }}</strong>
							</span>
							@enderror
						</div>
					</div>
					<div class="row mb-3">
						<label for="apartment" class="col-md-4 col-form-label text-md-end">マンション名</label>
						<div class="col-md-6">
							<input id="apartment" type="text" class="form-control @error('apartment') is-invalid @enderror" name="apartment" value="{{ old('apartment',Auth::user()->apartment) }}" placeholder="□□マンション△△号室" autofocus>
							@error('apartment')
							<span class="invalid-feedback" role="alert">
								<strong>{{ $message }}</strong>
							</span>
							@enderror
						</div>
					</div>
					<div class="row mb-3">
						<label for="email" class="col-md-4 col-form-label text-md-end">メールアドレス <span class="badge rounded-pill bg-danger">必須</span></label>
						<div class="col-md-6">
							<input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email',Auth::user()->email) }}" required autocomplete="email">
							@error('email')
							<span class="invalid-feedback" role="alert">
								<strong>{{ $message }}</strong>
							</span>
							@enderror
						</div>
					</div>
					<div class="row mb-3">
						<label for="phone_number" class="col-md-4 col-form-label text-md-end">電話番号 <span class="badge rounded-pill bg-danger">必須</span></label>
						<div class="col-md-6">
							<input id="phone_number" type="text" class="form-control @error('phone_number') is-invalid @enderror" name="phone_number" value="{{ old('phone_number',Auth::user()->phone_number) }}" placeholder="09012345678" required autocomplete="tel" autofocus>
							@error('phone_number')
							<span class="invalid-feedback" role="alert">
								<strong>{{ $message }}</strong>
							</span>
							@enderror
						</div>
					</div>
					<div class="row mb-3">
						<legend class="col-md-4 col-form-label text-md-end">支払い方法<span class="badge rounded-pill bg-danger">必須</span>
						</legend>
						<div class="col-md">
							<fieldset class="row mb-2 @error('gender') is-invalid @enderror" required>
								<div class="col-sm-10 mt-2">
									<div class="form-check">
										<input class="form-check-input" type="radio" name="payment_method" id="payment_method1" value="現金" @if( old('payment_method','')=='現金' )checked @endif required>
										<label class="form-check-label" for="payment_method1">
											現金
										</label>
									</div>
									@if( session('data.buys')->first()->kind->product->user->admin==1)
									<div class="form-check">
										<input class="form-check-input" type="radio" name="payment_method" id="payment_method2" value="クレジット" @if( old('payment_method','')=='クレジット' )checked @endif required>
										<label class="form-check-label" for="payment_method2">
											クレジット
										</label>
									</div>
									@endif
								</div>
							</fieldset>
							@error('payment_method')
							<span class="invalid-feedback" role="alert">
								<strong>{{ $message }}</strong>
							</span>
							@enderror
						</div>
						<div class="card mt-5 mb-5 p-3 bg-light">
							<h5 class="card-title mb-3">販売者名 ： {{session('data.buys')->first()->kind->product->user->user_name}}</h5>
							@foreach(session('data.buys') as $buy)
							<div class="card mb-3">
								<div class="row g-0 align-middle my-auto">
									<div class="col-1 align-middle my-auto" style="width:180px;height:180px;">
										<a href="{{ route('detail',$buy->kind->product->id) }}"> <img src="{{asset($buy->kind->product->product_main_image)}}" alt="商品メイン画像" style="width:180px;height:180px;" class="object-fit-cover"></a>
									</div>
									<div class="col row">
										<div class="col p-3 align-middle my-auto">
											<a href="{{ route('detail',$buy->kind->product->id) }}" class="text-decoration-none text-black">
												<h5 class="card-title mb-3">商品名 : {{$buy->kind->product->product_name}}</h5>
											</a>
											<p class="card-text align-middle">種類 : <span class="fs-5  align-middle">{{$buy->kind->kind_name}}</span></p>
											<p class="card-text align-middle">単価 : <span class="fs-5  align-middle">{{$buy->kind->product_price_with_tax}}</span></p>
											<p class="card-text align-middle">数量 : <span class="fs-5  align-middle">{{$buy->cart_quantity}}</span></p>
										</div>
										<div class="col-3 d-flex flex-flow text-end  align-middle my-auto">
											<h5 class="m-3 text-start align-middle my-auto">金額 :</h5>
											<h5 class="text-end align-middle my-auto ms-auto">{{$buy->kind->product_price_with_tax*$buy->cart_quantity}}円</h5>
										</div>
									</div>
								</div>
							</div>
							@endforeach
							<div class="card-body text-end">
								<h5 class="card-title mb-3">合計金額 : {{session('data.sum')}}円</h5>

								<button type="submit" class="btn btn-success text-center align-middle my-auto" name="buy" value=""> 購入</button>

							</div>
						</div>
				</form>
			</div>
		</div>
	</div>
</div>
<script src="https://js.stripe.com/v3/"></script>
<script src="js/payment.js"></script>
@endsection