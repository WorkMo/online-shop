@extends('layouts.seller')
@section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-9">
			<div class="card">
				<div class="card-header">新規登録</div>
				<div class="card-body">
					<form method="POST" action="{{ route('product_register') }}" enctype="multipart/form-data">
						@csrf
						<div class="row mb-3">
							<label for="product_name" class="col-md-4 col-form-label text-md-end">商品名</label>
							<div class="col-md-6">
								<input id="product_name" type="text" class="form-control @error('product_name') is-invalid @enderror" name="product_name" value="{{ old('product_name') }}" placeholder="" required autocomplete="" autofocus>
								@error('product_name')
								<span class="invalid-feedback" role="alert">
									<strong>{{ $message }}</strong>
								</span>
								@enderror
							</div>
						</div>
						<div class="row mb-3">
							<label for="product_keyword" class="col-md-4 col-form-label text-md-end">商品キーワード</label>
							<div class="col-md-6">
								<textarea id="product_keyword" cols="30" rows="3" class="form-control @error('product_keyword') is-invalid @enderror" name="product_keyword" autofocus>{{ old('product_keyword','') }}</textarea>
								@error('product_keyword')
								<span class="invalid-feedback" role="alert">
									<strong>{{ $message }}</strong>
								</span>
								@enderror
							</div>
						</div>

						<div class="row mb-3">
							<label for="product_category_id" class="col-md-4 col-form-label text-md-end">商品カテゴリー</label>
							<div class="col-md-6">
								<select input id="product_category_id" class="form-select @error('product_category_id') is-invalid @enderror" name="product_category_id" required autofocus>
									<option hidden value="{{ old('product_category_id','') }}">{{ old('product_category_id','選択してください') }}</option>
									@foreach($product_categories as $product_category)
									<option value="{{ $product_category->id }}">{{ $product_category->category_name }}</option>
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
							<label for="product_detail" class="col-md-4 col-form-label text-md-end">商品説明</label>
							<div class="col-md-6">
								<textarea id="product_detail" cols="30" rows="10" class="form-control @error('product_detail') is-invalid @enderror" name="product_detail" required autofocus></textarea>
								@error('product_detail')
								<span class="invalid-feedback" role="alert">
									<strong>{{ $message }}</strong>
								</span>
								@enderror
							</div>
						</div>
						<div class="row mb-3">
							@if( session('data.main_image_path') !== null)
							<label for="" class="col-md-4 col-form-label text-md-end">メイン画像</label>
							<div class="col-md-6">
								<div class=" main_image_form mb-2">
									<div class="card text-center border border-1 border-light bg-light">
										<div>


											<div class="product_main_image_temp input-group">
												<span class="input-group-text" id="basic-addon3">ファイルを選択</span>
												<input type="button" class="form-control text-start" id="basic-url" aria-describedby="basic-addon3" name="product_main_image" value="{{ session('data.main_image_name') }}" readonly>
											</div>
											<input id="product_main_image" type="file" class="d-none main_form form-control @error('product_main_image') is-invalid @enderror" name="product_main_image" value="{{ old('product_main_image') }}" autofocus>
										</div>
										<div class="card-body text-center main_preview_form border rounded border-top-0">
											<img src="{{asset(session('data.main_image_path'))}}" id="main_preview_temp" class="main_preview rounded w-50 object-fit-cover">
										</div>
									</div>
									@error('product_main_image')
									<span class="invalid-feedback" role="alert">
										<strong>{{ $message }}</strong>
									</span>
									@enderror
								</div>
							</div>
							@else
							<label for="" class="col-md-4 col-form-label text-md-end">メイン画像</label>
							<div class="col-md-6">
								<div class=" main_image_form mb-2">
									<div class="card text-center border border-1 border-light bg-light">
										<div>
											<input id="product_main_image" type="file" class="main_form form-control @error('product_main_image') is-invalid @enderror" name="product_main_image" value="" autofocus>
										</div>
										<div class="card-body text-center main_preview_form border rounded border-top-0">
											<img src="" id="main_preview" class="main_preview rounded w-50 object-fit-cover">
										</div>
									</div>
									@error('product_main_image')
									<span class="invalid-feedback" role="alert">
										<strong>{{ $message }}</strong>
									</span>
									@enderror
								</div>
							</div>
							@endif
						</div>
						<div class="row mb-3">
							<label for="" id="product_image_label" class="col-md-4 col-form-label text-md-end">商品画像</label>
							<div class="col-md-6">






								<div class=" product_image_form mb-2">
									<div class="card text-center border border-1 border-light bg-light">
										<div class="input-group">
											<input id="product_image" type="file" class="image_form form-control @error('product_image') is-invalid @enderror" name="product_image" value="" autofocus>
											<input type="button" value="＋" class="add btn btn-outline-secondary border">
											<input type="button" value="－" class="del btn btn-outline-secondary border">
										</div>
										<div class="preview_form card-body text-center  border rounded border-top-0">
											<img src="" id="preview" class="preview rounded w-50 object-fit-cover">
										</div>
									</div>
									@error('product_image')
									<span class="invalid-feedback" role="alert">
										<strong>{{ $message }}</strong>
									</span>
									@enderror
								</div>
							</div>
						</div>
						<div class="row mb-0">
							<div class="col-md-6 offset-md-4">
								<button type="submit" class="btn btn-primary">
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