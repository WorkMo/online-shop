@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
	<div class="col-md-9">
		<div class="card mb-5">
			<div class="card-header">
				購入状況
			</div>
			<div class="card-body p-4">
				<div class="mb-2">購入総額：{{$category_percent['sum_price']}}円(購入数量：{{$category_percent['sum_quantity']}}個、購入回数：{{$category_percent['sum_count']}}回)</div>
				<div class="progress mb-4">
					<?php $i = 0; ?>
					@foreach($category_percent['group'] as $key=>$data)
					<div class="progress-bar border" role="progressbar" style="width:{{$data['percent']}}%;color:{{$category_percent['color'][$category_percent['bg-color'][$i]]}};background-color:{{$category_percent['bg-color'][$i]}};" aria-valuenow="{{$data['percent']}}" aria-valuemin="0" aria-valuemax="100">{{$key}}:{{$data['percent']}}%</div>
					<?php $i++; ?>
					@endforeach
				</div>
				<div>
					<?php $i = 0; ?>
					<table class="table">
						<thead>
							<tr>
								<th scope="col"></th>
								<th scope="col">カテゴリー名</th>
								<th scope="col">割合</th>
								<th scope="col">購入金額</th>
								<th scope="col">購入数量</th>
								<th scope="col">購入回数</th>

							</tr>
						</thead>
						<tbody>
							@foreach($category_percent['group'] as $key=>$data)
							<tr>
								<th scope="row"><?= $i + 1 ?></th>
								<td><span style="color:{{$category_percent['bg-color'][$i]}};-webkit-text-stroke: 1px gray;
text-stroke: 1px gray;">■</span>{{$key}}</td>
								<td>{{$data['percent']}}%</td>
								<td>{{$data['price']}}円</td>
								<td>{{$data['quantity']}}個</td>
								<td>{{$data['count']}}回</td>
							</tr>
							<?php $i++; ?>
							@endforeach
						</tbody>
					</table>
				</div>

			</div>
		</div>
		<div class="card">
			<div class="card-header">購入履歴</div>
			<div class="card-body p-4 ">
				@if($order_histories=='')
				<p class="text-center">購入履歴はありません。</p>
				@else
				@foreach($order_histories as $order_history)
				<div class="card mb-5 p-3 bg-light">
					<p>請求書番号：{{$order_history->first()->invoice_id}}</p>
					<p>購入日：{{$order_history->first()->created_at->format('Y年m月d日')}}</p>
					<h5 class="card-title mb-3">販売者名 ： {{$order_history->first()->seller_name}}</h5>
					@isset($order_item->reviewCompany)
					<a class="text-end p-2" href="{{route('review_company_form',$order_history->first()->id)}}"><button class="btn btn-success text-nowrap">会社レビュー確認</button></a>
					@else
					<a class="text-end p-2  position-absolute top-0 end-0" href="{{route('review_company_form',$order_history->first()->id)}}"><button class="btn btn-outline-success text-nowrap">会社レビュー投稿</button></a>
					@endempty


					@foreach($order_history as $order_item)
					<div class="card mb-3">
						<div class="row g-0 align-middle my-auto">
							<div class="col-1 align-middle my-auto" style="width:180px;height:180px;">
								<a href="{{ route('detail',$order_item->kind->product_id) }}"> <img src="{{asset($order_item->bought_main_image)}}" alt="商品メイン画像" style="width:180px;height:180px;" class="object-fit-cover border"></a>
							</div>
							<div class="col row">
								<div class="col p-3 align-middle my-auto">
									<a href="{{ route('detail',$order_item->kind->product_id) }}" class="text-decoration-none text-black">
										<h5 class="card-title mb-3">商品名 : {{$order_item->bought_name}}</h5>
									</a>
									<p class="card-text ">種類 : {{$order_item->kind->kind_name}}</p>
									<p class="card-text ">単価 : {{number_format($order_item->bought_price_with_tax)}}</p>
									<p class="card-text align-middle">数量 : <span class="fs-5  align-middle">{{$order_item->bought_quantity }}</span></p>
								</div>
								<div class="col-3 d-flex flex-flow text-end  align-middle my-auto">
									<h5 class="m-3 text-start align-middle my-auto">金額 :</h5>
									<h5 class="text-end align-middle my-auto ms-auto">{{number_format($order_item->bought_price_with_tax*$order_item->bought_quantity)}}円</h5>
								</div>
							</div>
							@isset($order_item->review)
							<a class="text-end p-2 position-absolute bottom-0 end-0" href="{{route('review_list')}}#{{$order_item->review->id}}"><button class="btn btn-success text-nowrap">商品レビュー確認
								</button></a>
							@else
							<a class="text-end p-2 position-absolute bottom-0 end-0" href="{{route('review_form',$order_item->id)}}"><button class="btn btn-outline-success text-nowrap ">商品レビュー投稿
								</button></a>
							@endempty
						</div>
					</div>
					@endforeach
					<div class="card-body text-end">
						<h5 class="card-title mb-3">合計金額 : {{number_format($sum[$order_history->first()->invoice_id])}}円</h5>
					</div>
				</div>
				@endforeach
				@endif
			</div>
		</div>
	</div>
</div>
@endsection