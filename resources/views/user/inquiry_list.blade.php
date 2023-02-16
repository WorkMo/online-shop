@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
	<div class="col-md-9">

		<div class="card text-center">
			<div class="card-header">
				<h4>投稿一覧</h4>
				<ul class="nav nav-tabs card-header-tabs row">
					<li class="nav-item col">
						<a class="nav-link border border-bottom-0" href="{{route('review_list')}}">レビュー</a>
					</li>
					<li class="nav-item col">
						<a class="nav-link active" aria-current="true" href="{{route('inquiry_list')}}">質問</a>
					</li>
					<li class="nav-item col">
						<a class="nav-link border border-bottom-0" href="{{route('post_list')}}">自由投稿</a>
					</li>
				</ul>
			</div>
			<div class="card-body">
				<h5 class="card-title">Special title treatment</h5>
				<p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
				<a href="#" class="btn btn-primary">Go somewhere</a>
			</div>
		</div>

	</div>
</div>
@endsection