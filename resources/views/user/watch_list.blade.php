@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
	<div class="col-md-9">
		<div class="p-4 card">
			<form action="">
				@csrf
				<input type="search" name="keyword">
			</form>
			@if($products->isEmpty())
			<p class="text-center m">商品はありません</p>
			@else

			<div class="row row-cols-2 row-cols-sm-3 row-cols-md-5 g-4">
				@foreach($products as $product)
				<div class="col">
					<a class="text-decoration-none  link-dark" href="{{ route('detail') }}">
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