@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
	<div class="col-md-9">
		<div class="p-4 card">
			<form class="d-flex col-md-7 mx-auto mb-5">
				@csrf
				<input class="form-control me-2" type="search" placeholder="" aria-label="Search" name="keyword">
				<button class="btn btn-outline-success text-nowrap" type="submit">
					<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
						<path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
					</svg>
					検索
				</button>
			</form>
			@if($products->isEmpty())
			<p class="text-center m">商品はありません</p>
			@else

			<div class="row row-cols-2 row-cols-sm-3 row-cols-md-5 g-4">
				@foreach($products as $product)
				<div class="col">
					<a class="text-decoration-none  link-dark" href="{{ route('detail',$product->id) }}">
						<div class="card bg-light h-100">
							<img src="{{asset($product->product_main_image)}}" class="card-img-top h-50 object-fit-cover" alt="...">
							<div class="card-body">
								<h6 class="card-title" style="height:2.3em;overflow: hidden;display: -webkit-box;-webkit-box-orient: vertical;-webkit-line-clamp: 2;">{{$product->product_name}}</h6>
								<p class="card-text">{{$product->product_price_with_tax}}</p>
								<p class="card-text Stars" style="--rating: {{$product->reviews_avg_review_rating}};">{{$product->count_reviews}}</p>
							</div>
						</div>
					</a>
				</div>
				@endforeach
			</div>

			@endif
		</div>
	</div>
</div>
@endsection