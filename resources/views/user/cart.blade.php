@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
	<div class="col-md-9">
		<div class="card">
			<div class="card-header">カート</div>
			<div class="card-body p-4 ">

				@empty($carts)
				<p class="text-center">カートに商品はありません</p>
				@else
				@foreach($carts as $cart_shops)
				<div class="card mb-5 p-3 bg-light">
					<h5 class="card-title mb-3">販売者名 ： {{$cart_shops['0']['kind']['product']['user']['user_name']}}</h5>

					@foreach($cart_shops as $cart_shop)
					<div class="card mb-3">
						<div class="row g-0 align-middle my-auto">
							<div class="col-1 align-middle my-auto" style="width:180px;height:180px;">
								<a href="{{ route('detail',$cart_shop['kind']['product']['id']) }}"> <img src="{{$cart_shop['kind']['product']['product_main_image']}}" alt="商品メイン画像" style="width:180px;height:180px;" class="object-fit-cover"></a>
							</div>
							<div class="col row">
								<div class="col p-3 align-middle my-auto">
									<a href="{{ route('detail',$cart_shop['kind']['product']['id']) }}" class="text-decoration-none text-black">
										<h5 class="card-title mb-3">商品名 : {{$cart_shop['kind']['product']['product_name']}}</h5>
									</a>
									<p class="card-text ">種類 : {{$cart_shop['kind']['kind_name']}}</p>
									<p class="card-text ">単価 : {{number_format($cart_shop['kind']['product_price_with_tax'])}}</p>

									<form method="POST" action="{{route('cart_update')}}">
										@csrf
										<p class="card-text d-flex align-middle my-auto">
											<span class="align-middle my-auto">数量 :</span>

											<input type="number" min="1" max="9999" class="form-control w-25" name="cart_quantity" value="{{$cart_shop['cart_quantity']}}">
											<button type="submit" class="btn btn-success text-center align-middle my-auto" name="update" value="{{$cart_shop['id']}}">変更</button>

										</p>
									</form>
								</div>
								<div class="col-4 d-flex flex-flow text-end  align-middle my-auto">
									<h5 class="text-start align-middle my-auto">金額 :</h5>
									<h5 class="text-end align-middle my-auto ms-auto">{{number_format($cart_shop['kind']['product_price_with_tax']*$cart_shop['cart_quantity'])}}円</h5>
								</div>
								<div class="col-2 d-flex flex-flow text-end  align-middle my-auto">
									<a href="{{route('cart_delete',$cart_shop['id'])}}">
										<h5 class="text-end align-middle my-auto ms-auto"><button type="submit" class="btn btn-success text-center align-middle my-auto delete"> 削除</button></h5>
									</a>
								</div>
							</div>
						</div>
					</div>
					@endforeach
					<div class="card-body text-end">
						<h5 class="card-title mb-3">合計金額 : {{number_format($sum[$cart_shops['0']['kind']['product']['user']['user_name']])}}円</h5>
						<a href="{{ route('buy_form',['seller'=>$cart_shops['0']['kind']['product']['user_id']]) }}">
							<button class="btn btn-success text-center align-middle my-auto"> 購入</button>
						</a>

					</div>
				</div>
				@endforeach
				@endif
			</div>
		</div>
	</div>
</div>
@endsection