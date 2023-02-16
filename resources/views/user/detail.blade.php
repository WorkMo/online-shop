@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
	<div class="col-md-9">
		<div class="p-4 card container-fluid">
			<div class="row row-cols-2 ">
				<div class="card border-0 col">
					<div class="h-100">
						<div id="carouselExampleControlsNoTouching" class="carousel slide" data-bs-touch="true" data-bs-interval="false">
							@if($product->image_count >1)
							<div class="carousel-indicators">
								<button type="button" data-bs-target="#carouselExampleControlsNoTouching" data-bs-slide-to="0" aria-current="true" aria-label="Slide 1" class="active">
								</button>
								@for($i=1;$i<$product->image_count;$i++)
									<button type="button" data-bs-target="#carouselExampleControlsNoTouching" data-bs-slide-to="<?= $i ?>" aria-label="Slide <?= $i + 1 ?>">
									</button>
									@endfor
							</div>
							@endif
							<div class="carousel-inner  border rounded-4">
								<div class="carousel-item active">
									<img src="{{asset($product->product_images[0])}}" class="object-fit-contain d-block w-100" alt="商品画像1" data-bs-toggle="modal" data-bs-target="#product_image_Modal1">
								</div>
								<div class="modal fade" id="product_image_Modal1" tabindex="-1" aria-hidden="true">
									<div class="modal-dialog">
										<div class="modal-content  border-0 rounded-4">
											<img src="{{asset($product->product_images[0])}}" class=" border-0 rounded-4 d-block object-fit-none" alt="商品画像1" style="width:100%;height:100%;">
										</div>
									</div>
								</div>
								@if($product->image_count>1)
								@for($i=1;$i<$product->image_count;$i++)
									<div class="carousel-item">
										<img src="{{asset($product->product_images[$i])}}" class="object-fit-contain d-block w-100" alt="商品画像<?= 1 + $i ?>" data-bs-toggle="modal" data-bs-target="#product_image_Modal<?= 1 + $i ?>">
									</div>
									<div class="modal fade" id="product_image_Modal<?= 1 + $i ?>" tabindex="-1" aria-hidden="true">
										<div class="modal-dialog">
											<div class="modal-content  border-0 rounded-4">
												<img src="{{asset($product->product_images[$i])}}" class=" border-0 rounded-4 d-block object-fit-none" alt="商品画像1" style="width:100%;height:100%;">
											</div>
										</div>
									</div>
									@endfor
									@endif
							</div>
							@if($product->image_count>1)
							<button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControlsNoTouching" data-bs-slide="prev">
								<span class="carousel-control-prev-icon" aria-hidden="true"></span>
								<span class="visually-hidden">Previous</span>
							</button>
							<button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControlsNoTouching" data-bs-slide="next">
								<span class="carousel-control-next-icon" aria-hidden="true"></span>
								<span class="visually-hidden">Next</span>
							</button>
							@endif
						</div>
						<div class="carousel slide text-center border-0">
							@if($product->image_count >1)
							<div class="">
								<button type=" button" data-bs-target="#carouselExampleControlsNoTouching" data-bs-slide-to="0" aria-current="true" aria-label="Slide 1" class="border-0 active">
									<img src="{{asset($product->product_images[0])}}" alt="" style="width:50px;height:50px;" class="object-fit-cover">
								</button>
								@for($i=1;$i<$product->image_count;$i++)
									<button type="button" data-bs-target="#carouselExampleControlsNoTouching" data-bs-slide-to="<?= $i ?>" aria-label="Slide <?= $i + 1 ?>" class="border-0">
										<img src="{{asset($product->product_images[$i])}}" alt="" style="width:50px;height:50px;" class="object-fit-cover">
									</button>
									@endfor
							</div>
							@endif
						</div>
					</div>
				</div>
				<div class="fs-1 col">
					<div class="h-100">
						<div class="fs-1 h-50 card col p-3 overflow-auto">
							{{$product->product_name}}
						</div>
						<div class="fs-1 h-50 card col overflow-auto">
							<form method="POST" action="{{ route('kind_register') }}">
								@csrf

								<div class="input-group mb-3">
									<label class="input-group-text" for="kind_id">商品</label>
									<select input id="kind_id" class="form-select @error('kind_id') is-invalid @enderror" name="kind_id" required autofocus>
										<option hidden value="{{ old('kind_id','') }}">{{ old('kind_id','選択してください') }}</option>
										@foreach($product->kinds as $kind)
										<option value="{{$kind->id}}">{{$kind->kind_name}}</option>
										@endforeach
									</select>
									@error('prefecture')
									<span class="invalid-feedback" role="alert">
										<strong>{{ $message }}</strong>
									</span>
									@enderror
								</div>
								<div class="row text-center">
									<label for="stock_quantity" class="col col-form-label text-md-end fs-5">数量</label>
									<div class="col">
										<input id="stock_quantity" type="number" min="1" max="99999999999" class="form-control w-50 @error('stock_quantity') is-invalid @enderror" name="stock_quantity" value="{{ old('stock_quantity',1) }}" placeholder="" autocomplete="" autofocus>
										@error('stock_quantity')
										<span class="invalid-feedback" role="alert">
											<strong>{{ $message }}</strong>
										</span>
										@enderror
									</div>
								</div>
								<div class="row mb-0">
									<div class="text-center align-middle my-auto">
										<button type="button" class="btn btn-success text-center align-middle my-auto"> カートに入れる</button>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>

			<div class="card fs-1 m-2 overflow-auto">
				{{$product->product_detail}}
			</div>
			<div class="card fs-1 m-2 overflow-auto">
				レビュー
			</div>
			<div class="card fs-1 m-2 overflow-auto">
				会社概要
			</div>
		</div>
	</div>
	@endsection