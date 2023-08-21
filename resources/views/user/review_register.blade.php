@extends('layouts.seller')
@section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-9">
			<div class="card">
				<div class="card-header">商品レビュー登録</div>
				<div class="card-body">
					<form method="POST" action="{{ route('review_register') }}" enctype="multipart/form-data">
						@csrf
						<div class="row mb-1">
							<label for="product_name" class="col-md-4 col-form-label text-md-end">商品名</label>
							<div class="col-md-6">
								<p class="fs-4">{{$buy_data->kind->product->product_name}}</p>
							</div>
						</div>
						<div class="row mb-3">
							<label for="review_name" class="col-md-4 col-form-label text-md-end">名前 <span class="badge rounded-pill bg-danger">必須</span></label>
							<div class="col-md-6">
								<input id="review_name" type="text" class="form-control @error('review_name') is-invalid @enderror" name="review_name" value="{{ old('review_name') }}" placeholder="" required autocomplete="" autofocus>
								@error('review_name')
								<span class="invalid-feedback" role="alert">
									<strong>{{ $message }}</strong>
								</span>
								@enderror
							</div>
						</div>

						<div class="row mb-3">
							<legend class="col-md-4 col-form-label text-md-end mt-2">レビュー評価 <span class="badge rounded-pill bg-danger">必須</span>
							</legend>
							<div class="col-md-6">
								<fieldset class="row mb-2 @error('review_rating') is-invalid @enderror" required>
									<input class="d-none" type="radio" name="review_rating" id="star-null @if( old('review_rating','')=='' )checked @endif " hidden />
									<input class="d-none" type="radio" name="review_rating" id="star-1" value="1" hidden @if( old('review_rating','')=='1' )checked @endif />
									<input class="d-none" type="radio" name="review_rating" id="star-2" value="2" hidden @if( old('review_rating','')=='2' )checked @endif />
									<input class="d-none" type="radio" name="review_rating" id="star-3" value="3" hidden @if( old('review_rating','')=='3' )checked @endif />
									<input class="d-none" type="radio" name="review_rating" id="star-4" value="4" hidden @if( old('review_rating','')=='4' )checked @endif />
									<input class="d-none" type="radio" name="review_rating" id="star-5" value="5" hidden @if( old('review_rating','')=='5' )checked @endif />

									<section>
										<label class="star-label" for="star-1">
											<svg width="255" height="240" viewBox="0 0 51 48">
												<path d="m25,1 6,17h18l-14,11 5,17-15-10-15,10 5-17-14-11h18z" />
											</svg>
										</label>
										<label class="star-label" for="star-2">
											<svg width="255" height="240" viewBox="0 0 51 48">
												<path d="m25,1 6,17h18l-14,11 5,17-15-10-15,10 5-17-14-11h18z" />
											</svg>
										</label>
										<label class="star-label" for="star-3">
											<svg width="255" height="240" viewBox="0 0 51 48">
												<path d="m25,1 6,17h18l-14,11 5,17-15-10-15,10 5-17-14-11h18z" />
											</svg>
										</label>
										<label class="star-label" for="star-4">
											<svg width="255" height="240" viewBox="0 0 51 48">
												<path d="m25,1 6,17h18l-14,11 5,17-15-10-15,10 5-17-14-11h18z" />
											</svg>
										</label>
										<label class="star-label" for="star-5">
											<svg width="255" height="240" viewBox="0 0 51 48">
												<path d="m25,1 6,17h18l-14,11 5,17-15-10-15,10 5-17-14-11h18z" />
											</svg>
										</label>
									</section>
								</fieldset>
								@error('review_rating')
								<span class="invalid-feedback" role="alert">
									<strong>{{ $message }}</strong>
								</span>
								@enderror
							</div>
						</div>
						<div class="row mb-3">
							<label for="review_text" class="col-md-4 col-form-label text-md-end">レビュー内容 <span class="badge rounded-pill bg-danger">必須</span></label>
							<div class="col-md-6">
								<textarea id="review_text" cols="30" rows="10" class="form-control @error('review_text') is-invalid @enderror" name="review_text" required autofocus></textarea>
								@error('review_text')
								<span class="invalid-feedback" role="alert">
									<strong>{{ $message }}</strong>
								</span>
								@enderror
							</div>
						</div>
						<div class="row mb-3">
							<label for="" id="review_image_label" class="col-md-4 col-form-label text-md-end">レビュー画像</label>
							<div class="col-md-6">

								<div class="review_image_form mb-2">
									<div class="card text-center border border-1 border-light bg-light">
										<div class="input-group">
											<input id="review_image" type="file" class="review_image_input form-control @error('review_image') is-invalid @enderror" name="review_image" value="" autofocus>
											<input type="button" value="＋" class="add btn btn-outline-secondary border">
											<input type="button" value="－" class="del btn btn-outline-secondary border">
										</div>
										<div class="preview_form card-body text-center  border rounded border-top-0">
											<img src="" id="preview" class="preview rounded w-50 object-fit-cover">
										</div>
									</div>
									@error('review_image')
									<span class="invalid-feedback" role="alert">
										<strong>{{ $message }}</strong>
									</span>
									@enderror
								</div>
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