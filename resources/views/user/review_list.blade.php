@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
	<div class="col-md-9">

		<div class="card text-center">
			<div class="card-header">
				<h4>投稿一覧</h4>
				<ul class="nav nav-tabs card-header-tabs row">
					<li class="nav-item col">
						<a class="nav-link active" aria-current="true" href="{{route('review_list')}}">レビュー</a>
					</li>
				</ul>
			</div>
			<div class="card-body">
				@foreach($reviews as $review)
				<div class="card mb-5 p-3 bg-light" id="{{$review->id}}">

					<div class="card border border-0">
						<div class="row g-0 align-middle my-auto text-start">
							<div class="col-1 align-middle my-auto" style="width:180px;height:180px;">
								<a href="{{ route('detail',$review->buy->kind->product_id) }}"> <img src="{{asset($review->buy->bought_main_image)}}" alt="商品メイン画像" style="width:180px;height:180px;object-fit:container;"></a>
							</div>
							<div class="col row bg-light border border-0">
								<div class="col p-3 align-middle my-auto ">
									<a href="{{ route('detail',$review->buy->kind->product_id) }}" class="text-decoration-none text-black">
										<p class="card-title mb-3 fs-6">商品名 : {{$review->buy->bought_name}}</p>
									</a>
									<p class="card-title mb-3 fs-6">表示名 : {{$review->review_name}}</p>
									<p class="card-title mb-3 fs-6">評　価 : <span class="card-text Stars" style="--rating: {{$review->review_rating }};">
										</span></p>
									<p class="card-title mb-3 fs-6">投稿日 : {{($review->created_at->format('Y年m月d日'))}}</p>
								</div>
								<div class="col-7 text-start align-start fs-5 card">
									{{$review->review_text}}
									<div class="d-flex lex-flow">
										@if($review->review_images_count>0)
										@foreach($review->reviewImages as $reviewImage)
										<img src="{{asset($reviewImage->review_image)}}" style="width:150px;height:150px;" class="border" alt="">
										@endforeach
										@endif
									</div>
								</div>
								<div class="col-1 text-start align-start fs-5 ">

								</div>
							</div>
						</div>
					</div>
				</div>
				@endforeach
			</div>
		</div>

	</div>
</div>
@endsection