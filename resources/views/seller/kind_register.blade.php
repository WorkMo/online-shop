@extends('layouts.seller')
@section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-9">
			<div class="card">
				<div class="card-header">商品種類登録</div>
				<div class="card-body">
					<form method="POST" action="{{ route('kind_register') }}">
						@csrf
						<div class="row mb-1">
							<label for="product_name" class="col-md-4 col-form-label text-md-end">商品名</label>
							<div class="col-md-6">
								<p class="fs-4">{{$product_name}}</p>
							</div>
						</div>

						<div class="row mb-3">
							<label for="kind_name" class="col-md-4 col-form-label text-md-end">商品種類名</label>
							<div class="col-md-6">
								<input id="kind_name" type="text" class="form-control @error('kind_name') is-invalid @enderror" name="kind_name" value="{{ old('kind_name') }}" placeholder="" required autocomplete="" autofocus>
								@error('kind_name')
								<span class="invalid-feedback" role="alert">
									<strong>{{ $message }}</strong>
								</span>
								@enderror
							</div>
						</div>
						<div class="row mb-3">
							<label for="barcode" class="col-md-4 col-form-label text-md-end">JANコード</label>
							<div class="col-md-6">
								<input id="barcode" type="text" class="form-control @error('barcode') is-invalid @enderror" name="barcode" value="{{ old('barcode') }}" placeholder="" autocomplete="" autofocus>
								@error('barcode')
								<span class="invalid-feedback" role="alert">
									<strong>{{ $message }}</strong>
								</span>
								@enderror
							</div>
						</div>
						<div class="row mb-3">
							<label for="code" class="col-md-4 col-form-label text-md-end">品番</label>
							<div class="col-md-6">
								<input id="code" type="text" class="form-control @error('code') is-invalid @enderror" name="code" value="{{ old('code') }}" placeholder="" autocomplete="" autofocus>
								@error('code')
								<span class="invalid-feedback" role="alert">
									<strong>{{ $message }}</strong>
								</span>
								@enderror
							</div>
						</div>


						<div class="row mb-3">
							<label for="product_price_with_tax" class="col-md-4 col-form-label text-md-end">商品価格（税込）
							</label>
							<div class="col-md-6">
								<div class="input-group">
									<input id="product_price_with_tax" type="text" class="form-control text-md-end @error('product_price_with_tax') is-invalid @enderror" name="product_price_with_tax" value="{{ old('product_price_with_tax') }}" placeholder="" required autocomplete="" autofocus>
									<span class="input-group-text">円</span>
								</div>
								@error('product_price_with_tax')
								<span class="invalid-feedback" role="alert">
									<strong>{{ $message }}</strong>
								</span>
								@enderror
							</div>
						</div>

						<div class="row mb-3">
							<label for="product_tax_rate" class="col-md-4 col-form-label text-md-end">消費税率
							</label>
							<div class="col-md-6">

								<div class="input-group">
									<select input id="product_tax_rate" class="form-select" name="product_tax_rate" required autocomplete="address-level1" autofocus>
										<option hidden value="{{ old('product_tax_rate','') }}">{{ old('product_tax_rate','選択してください') }}</option>
										@foreach(config('tax') as $key => $value)
										<option value="{{ $value }}">{{ $value }}</option>
										@endforeach
									</select>
								</div>
								@error('product_tax_rate')
								<span class="invalid-feedback" role="alert">
									<strong>{{ $message }}</strong>
								</span>
								@enderror
							</div>
						</div>

						<div class="row mb-3">
							<label for="stock_quantity" class="col-md-4 col-form-label text-md-end">在庫数</label>
							<div class="col-md-6">
								<input id="stock_quantity" type="number" min="1" max="99999999999" class="form-control @error('stock_quantity') is-invalid @enderror" name="stock_quantity" value="{{ old('stock_quantity') }}" placeholder="" autocomplete="" autofocus>
								@error('stock_quantity')
								<span class="invalid-feedback" role="alert">
									<strong>{{ $message }}</strong>
								</span>
								@enderror
							</div>
						</div>
						<div class="row mb-3">
							<label for="ordering_point" class="col-md-4 col-form-label text-md-end">発注点</label>
							<div class="col-md-6">
								<input id="ordering_point" type="number" min="1" max="99999999999" class="form-control @error('ordering_point') is-invalid @enderror" name="ordering_point" value="{{ old('ordering_point') }}" placeholder="" autocomplete="" autofocus>
								@error('ordering_point')
								<span class="invalid-feedback" role="alert">
									<strong>{{ $message }}</strong>
								</span>
								@enderror
							</div>
						</div>
						<div class="row mb-0">
							<div class="col-md-6 offset-md-4 text-center mt-3">
								<button type="submit" class="btn btn-primary w-50">
									登録
								</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection