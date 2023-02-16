@extends('layouts.app')
@section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-9">
			<div class="card">
				<div class="card-header">登録情報</div>
				<div class="card-body">
					<div class="row mb-3">
						<label for="user_name" class="col-md-4 col-form-label text-md-end">名前 </label>
						<div class="col-md-6">
							<div class="form-control h-100">{{$user->user_name}}</div>
						</div>
					</div>
					<div class="row mb-3">
						<label for="user_kana" class="col-md-4 col-form-label text-md-end">フリガナ </label>
						<div class="col-md-6">
							<div class="form-control h-100">{{$user->user_kana}}</div>
						</div>
					</div>
					<div class="row mb-3">
						<label for="post_code" class="col-md-4 col-form-label text-md-end">郵便番号 </label>
						<div class="col-md-6">
							<div class="form-control h-100">{{$user->post_code}}</div>
						</div>
					</div>
					<div class="row mb-3">
						<label for="prefecture" class="col-md-4 col-form-label text-md-end">都道府県 </label>
						<div class="col-md-6">
							<div class="form-control h-100">{{$user->prefecture}}</div>
						</div>
					</div>
					<div class="row mb-3">
						<label for="municipality" class="col-md-4 col-form-label text-md-end">市区町村番地 </label>
						<div class="col-md-6">
							<div class="form-control h-100">{{$user->municipality}}</div>
						</div>
					</div>
					<div class="row mb-3">
						<label for="apartment" class="col-md-4 col-form-label text-md-end">マンション名</label>
						<div class="col-md-6">
							<div class="form-control h-100">{{$user->apartment}}</div>
						</div>
					</div>
					<div class="row mb-3">
						<label for="email" class="col-md-4 col-form-label text-md-end">メールアドレス </label>
						<div class="col-md-6">
							<div class="form-control h-100">{{$user->email}}</div>
						</div>
					</div>
					<div class="row mb-3">
						<label for="phone_number" class="col-md-4 col-form-label text-md-end">電話番号 </label>
						<div class="col-md-6">
							<div class="form-control h-100">{{$user->phone_number}}</div>
						</div>
					</div>
					<div class="row mb-3">
						<label for="birthday" class="col-md-4 col-form-label text-md-end">生年月日 </label>
						<div class="col-md-6">
							<div class="form-control h-100">{{$user->birthday}}</div>
						</div>
					</div>
					<div class="row mb-3">
						<label for="gender" class="col-md-4 col-form-label text-md-end">性別 </label>
						<div class="col-md-6">
							<div class="form-control h-100">{{$user->gender}}</div>
						</div>
					</div>
					<div class="row mb-3">
						<label for="nickname" class="col-md-4 col-form-label text-md-end">ニックネーム</label>
						<div class="col-md-6">
							<div class="form-control h-100">{{$user->nickname}}</div>
						</div>
					</div>
					<div class="row mb-3">
						<label for="" class="col-md-4 col-form-label text-md-end">アイコン</label>
						<div class="col-md-6 mb-3">

							<img src="{{asset($user->icon)}}" id="icon_preview" class="icon_preview rounded w-50 text-center object-fit-cover">

						</div>
						<div class="row mb-3 text-center d-flex flex-flow">
							<div class="col">
								<a href=""><button class="btn btn-primary">
										編集
									</button></a>
							</div>
							<div class="col">
								<a href=""><button class="btn btn-primary">
										アカウント削除
									</button></a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	@endsection