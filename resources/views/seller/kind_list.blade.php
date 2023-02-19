@extends('layouts.seller')

@section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-9">
			<div class="card">
				<div class="card-header  d-flex flex-flow my-auto">種類一覧 <a href="{{route('kind_add')}}" class="ms-auto my-0">
						<button type="submit" class="btn btn-primary ">
							種類登録
						</button>
					</a>
				</div>
				<table class="table table-striped table-bordered mb-0">
					<tr class="text-center align-middle">
						<th> 種類名</th>
						<th> 公開非公開</th>
						<th> 販売価格（税込）</th>
						<th> 消費税率</th>
						<th> 在庫数</th>
						<th> 注文店</th>
						<th>メッセージ</th>
						<th> 詳細・編集</th>
						<th> 削除</th>
					</tr>
					@if($kinds=='')
					<tr class="text-center align-middle border-bottom-0">
						<td colspan="10">商品種類が登録されていません。</td>
					</tr>
					@else
					@foreach($kinds as $kind)
					<tr class="text-center align-middle">
						<td>{{$kind->kind_name}}</td>
						<td>{{$kind->kind_public}}</td>
						<td>{{$kind->product_price_with_tax}}</td>
						<td>{{$kind->product_tax_rate}}</td>
						<td>{{$kind->stock_quantity}}</td>
						<td>{{$kind->ordering_point}}</td>
						<td class="text-start">@if($kind->stock_quantity<$kind->ordering_point)注文点を下回りました。@endif</td>
						<td><a href="{{route('kind_detail',$kind->id)}}"><button class="btn btn-outline-dark">詳細</button></a></td>
						<td><a href="{{route('kind_delete',$kind->id)}}"><button class="btn btn-outline-dark delete">削除</button></a></td>
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