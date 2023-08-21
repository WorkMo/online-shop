@extends('layouts.admin')

@section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-9">
			<div class="card  mb-5">
				<div class="card-header">販売者申請中</div>
				<table class="table table-striped table-bordered mb-0">
					<tr class="text-center align-middle">
						<th> 申請者</th>
						<th class="col-1"> 詳細</th>
						<th class="col-1"> 承認</th>
						<th class="col-1"> 否認</th>
					</tr>
					@if($seller_requests->isEmpty())
					<tr class="text-center align-middle border-bottom-0">
						<td colspan="10">申請者はいません。</td>
					</tr>
					@else
					@foreach($seller_requests as $seller_request)
					<tr class="text-center align-middle">
						<td>{{$seller_request->user_name}}</td>
						<td class="col-1">
							<a href="{{route('seller_info',$seller_request->id)}}">
								<button class="btn btn-outline-dark">詳細</button></a>
						</td>
						<td class="col-1">
							<a href="{{route('seller_update',$seller_request->id)}}">
								<button class="btn btn-outline-dark">承認</button></a>
						</td>
						<td class="col-1">
							<a href="{{route('seller_delete',$seller_request->id)}}">
								<button class="btn btn-outline-dark delete">否認</button></a>
						</td>
					</tr>
					@endforeach
					@endif
				</table>
			</div>
			<div class="card ">
				<div class="card-header">販売者権限付与者</div>
				<table class="table table-striped table-bordered mb-0">
					<tr class="text-center align-middle">
						<th> 販売者</th>
						<th class="col-1"> 詳細</th>
						<th class="col-2"> 販売者権限削除</th>
					</tr>
					@if($sellers->isEmpty())
					<tr class="text-center align-middle border-bottom-0">
						<td colspan="10">申請者はいません。</td>
					</tr>
					@else
					@foreach($sellers as $seller)
					<tr class="text-center align-middle">
						<td>{{$seller->user_name}}</td>
						<td class="col-1">
							<a href="{{route('seller_info',$seller->id)}}">
								<button class="btn btn-outline-dark">詳細</button>
							</a>
						</td>
						<td class="col-2">
							<a href="{{route('seller_delete',$seller->id)}}">
								<button class="btn btn-outline-dark delete">権限削除</button>
							</a>
						</td>
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