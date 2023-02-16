@extends('layouts.seller')

@section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-9">
			<div class="card ">
				<table class="table table-striped table-bordered mb-0">
					<tr class="text-center align-middle">
						<th> 商品名</th>
						<th> 公開非公開</th>
						<th> カテゴリー</th>
						<th> 種類数</th>
						<th> レビュー評価</th>
						<th> 販売累計数</th>
						<th>メッセージ</th>
						<th> 詳細</th>
						<th> 編集</th>
						<th> 削除</th>
					</tr>
					@if($products->isEmpty())
					<tr class="text-center align-middle border-bottom-0">
						<td colspan="10">商品が登録されていません。</td>
					</tr>
					@else
					@foreach($products as $product)
					<tr class="text-center align-middle">
						<td>{{$product->product_name}}</td>
						<td>{{$product->product_public}}</td>
						<td>{{$product->productCategory->category_name}}</td>
						<td>{{$product->kinds_count}}</td>
						<td>{{$product->review_rating_average}}</td>
						<td>{{$product->total_sales}}</td>
						<td class="text-start">@if($product->kinds_count == 0)商品種類を登録してください。@endif</td>
						<td><button class="btn btn-outline-dark">詳細</button></td>
						<td><button class="btn btn-outline-dark">編集</button></td>
						<td><button class="btn btn-outline-dark">削除</button></td>
					</tr>
					@endforeach
					@endif
				</table>
			</div>
		</div>
	</div>
</div>
</div>
@endsection