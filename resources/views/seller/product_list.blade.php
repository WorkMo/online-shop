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
						<th> 詳細・編集</th>
						<th> 種類一覧</th>
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
						<td>{{number_format($product->kinds_count)}}</td>
						<td>{{$product->review_rating_average}}</td>
						<td>{{number_format($product->total_sales)}}</td>
						<td class="text-start">@if($product->kinds_count == 0)商品種類を登録してください。@endif</td>
						<td><a href="{{route('product_detail',$product->id)}}"><button class="btn btn-outline-dark">詳細</button></a></td>
						<td><a href="{{route('kind_list',$product->id)}}"><button class="btn btn-outline-dark">種類</button></a></td>
						<td><a href="{{route('product_delete',$product->id)}}"><button class="btn btn-outline-dark delete">削除</button></a></td>
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