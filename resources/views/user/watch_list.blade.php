@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
	<div class="col-md-9">
		<div class="p-4 card">
			<form class="d-flex col-md-7 mx-auto mb-5" action="{{route('search')}}">
				@csrf
				<div class="input-group">
					<input class="form-control me-2" type="search" placeholder="キーワード" aria-label="Search" name="keyword">
				</div>
				<button class="btn btn-outline-success text-nowrap" type="submit">
					<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
						<path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
					</svg>
					検索
				</button>
			</form>
			@if($products->isEmpty())
			<p class="text-center m">お気に入りはありません</p>
			@else

			<div class="row row-cols-2 row-cols-sm-3 row-cols-md-5 g-4">
				@foreach($products as $product)
				<div class="col">
					<div class="card bg-light h-100"><a class="text-decoration-none  link-dark" href="{{ route('detail',$product->id) }}">
							<div>
								<img src="{{asset($product->product_main_image)}}" class="card-img-top h-50 object-fit-cover" alt="...">
								<div class="card-body">
									<h6 class="card-title" style="height:2.3em;overflow: hidden;display: -webkit-box;-webkit-box-orient: vertical;-webkit-line-clamp: 2;">{{$product->product_name}}</h6>
									<p class="card-text">@if($product->kinds_min_product_price_with_tax == $product->kinds_Max_product_price_with_tax)
										{{number_format($product->kinds_min_product_price_with_tax)}}円（税込）~
										@else{{number_format($product->kinds_min_product_price_with_tax)}}円（税込）
										@endif
									</p>
									<p>
										<span class="card-text Stars" style="--rating: {{$product->review_rating_average }};">
										</span>
										<span>（{{number_format($product->review_rating_number??0)}}件）</span>
									</p>
								</div>
							</div>
						</a>
						<div class="position-absolute bottom-50 end-0">
							@auth
							@if (!$product->is_watch(Auth::user()))
							<span class="watches">
								<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-star-fill watch-toggle" viewBox="0 0 16 16" data-watch-id="{{ $product->id }}" style="width:30px;height:30px">
									<path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
								</svg>
								@else
								<span class="watches">

									<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-star-fill watch-toggle watched" viewBox="0 0 16 16" data-watch-id="{{$product->id }}" style="width:30px;height:30px">
										<path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
									</svg>
								</span>
								@endif
								@endauth

						</div>
					</div>
				</div>
				@endforeach
			</div>

			@endif
		</div>
	</div>
</div>
@endsection