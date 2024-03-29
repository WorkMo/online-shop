@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-9">
			<div class="card">
				<div class="card-header">新規登録</div>

				<div class="card-body">
					<form method="POST" action="{{ route('user_edit') }}" enctype="multipart/form-data">
						@csrf

						<div class="row mb-3">
							<label for="user_name" class="col-md-4 col-form-label text-md-end">名前</label>

							<div class="col-md-6">
								<input id="user_name" type="text" class="form-control @error('user_name') is-invalid @enderror" name="user_name" value="{{ old('user_name',$user->user_name) }}" placeholder="山田 太郎" required autocomplete="name" autofocus>

								@error('user_name')
								<span class="invalid-feedback" role="alert">
									<strong>{{ $message }}</strong>
								</span>
								@enderror
							</div>
						</div>

						<div class="row mb-3">
							<label for="user_kana" class="col-md-4 col-form-label text-md-end">フリガナ</label>

							<div class="col-md-6">
								<input id="user_kana" type="text" class="form-control @error('user_kana') is-invalid @enderror" name="user_kana" value="{{ old('user_kana',$user->user_kana) }}" placeholder="ヤマダ タロウ" required autocomplete="name" autofocus>

								@error('user_kana')
								<span class="invalid-feedback" role="alert">
									<strong>{{ $message }}</strong>
								</span>
								@enderror
							</div>
						</div>

						<div class="row mb-3">
							<label for="post_code" class="col-md-4 col-form-label text-md-end">郵便番号</label>

							<div class="col-md-6">
								<input id="post_code" type="text" class="form-control @error('post_code') is-invalid @enderror" name="post_code" value="{{ old('post_code',$user->post_code) }}" placeholder="123-4567" required autocomplete="postal-code" autofocus>

								@error('post_code')
								<span class="invalid-feedback" role="alert">
									<strong>{{ $message }}</strong>
								</span>
								@enderror
							</div>
						</div>

						<div class="row mb-3">
							<label for="prefecture" class="col-md-4 col-form-label text-md-end">都道府県</label>

							<div class="col-md-6">
								<select input id="prefecture" class="form-select @error('prefecture') is-invalid @enderror" name="prefecture" required autocomplete="address-level1" autofocus>
									<option hidden value="{{ old('prefecture',$user->prefecture) }}">{{ old('prefecture',$user->prefecture) }}</option>
									@foreach(config('prefecture') as $key => $value)
									<option value="{{ $value }}">{{ $value }}</option>
									@endforeach
								</select>

								@error('prefecture')
								<span class="invalid-feedback" role="alert">
									<strong>{{ $message }}</strong>
								</span>
								@enderror
							</div>
						</div>

						<div class="row mb-3">
							<label for="municipality" class="col-md-4 col-form-label text-md-end">市区町村番地</label>

							<div class="col-md-6">
								<input id="municipality" type="text" class="form-control @error('municipality') is-invalid @enderror" name="municipality" value="{{ old('municipality',$user->municipality) }}" placeholder="〇〇市〇〇町〇〇番〇〇" required autocomplete="address-level2" autofocus>

								@error('municipality')
								<span class="invalid-feedback" role="alert">
									<strong>{{ $message }}</strong>
								</span>
								@enderror
							</div>
						</div>

						<div class="row mb-3">
							<label for="apartment" class="col-md-4 col-form-label text-md-end">マンション名</label>

							<div class="col-md-6">
								<input id="apartment" type="text" class="form-control @error('apartment') is-invalid @enderror" name="apartment" value="{{ old('apartment',$user->apartment) }}" placeholder="□□マンション△△号室" autofocus>

								@error('apartment')
								<span class="invalid-feedback" role="alert">
									<strong>{{ $message }}</strong>
								</span>
								@enderror
							</div>
						</div>

						<div class="row mb-3">
							<label for="email" class="col-md-4 col-form-label text-md-end">メールアドレス</label>

							<div class="col-md-6">
								<input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email',$user->email) }}" required autocomplete="email">

								@error('email')
								<span class="invalid-feedback" role="alert">
									<strong>{{ $message }}</strong>
								</span>
								@enderror
							</div>
						</div>

						<div class="row mb-3">
							<label for="phone_number" class="col-md-4 col-form-label text-md-end">電話番号</label>

							<div class="col-md-6">
								<input id="phone_number" type="text" class="form-control @error('phone_number') is-invalid @enderror" name="phone_number" value="{{ old('phone_number',$user->phone_number) }}" placeholder="09012345678" required autocomplete="tel" autofocus>

								@error('phone_number')
								<span class="invalid-feedback" role="alert">
									<strong>{{ $message }}</strong>
								</span>
								@enderror
							</div>
						</div>

						<div class="row mb-3">
							<label for="birthday" class="col-md-4 col-form-label text-md-end">生年月日</label>

							<div class="col-md-6">
								<input id="birthday" type="date" class="form-control @error('birthday') is-invalid @enderror" name="birthday" value="{{ old('birthday',$user->birthday) }}" required autocomplete="bday" autofocus>

								@error('birthday')
								<span class="invalid-feedback" role="alert">
									<strong>{{ $message }}</strong>
								</span>
								@enderror
							</div>
						</div>

						<div class="row mb-3">
							<legend class="col-md-4 col-form-label text-md-end">性別
							</legend>
							<div class="col-md">
								<fieldset class="row mb-2 @error('gender') is-invalid @enderror" required>
									<div class="col-sm-10 mt-2">
										<div class="form-check form-check-inline">
											<input class="form-check-input" type="radio" name="gender" id="gender1" value="男性" @if( old('gender',$user->gender)=='男性' )checked @endif required>
											<label class="form-check-label" for="gender1">
												男性
											</label>
										</div>
										<div class="form-check form-check-inline">
											<input class="form-check-input" type="radio" name="gender" id="gender2" value="女性" @if( old('gender',$user->gender)=='女性' )checked @endif required >
											<label class="form-check-label" for="gender2">
												女性
											</label>
										</div>
										<div class="form-check form-check-inline">
											<input class="form-check-input" type="radio" name="gender" id="gender3" value="その他" @if( old('gender',$user->gender)=='その他' )checked @endif required>
											<label class="form-check-label" for="gender3">
												その他
											</label>
										</div>
										<div class="form-check form-check-inline">
											<input class="form-check-input" type="radio" name="gender" id="gender4" value="回答しない" @if( old('gender',$user->gender))=='回答しない' )checked @endif required>
											<label class="form-check-label" for="gender4">
												回答しない
											</label>
										</div>
									</div>
								</fieldset>
								@error('gender')
								<span class="invalid-feedback" role="alert">
									<strong>{{ $message }}</strong>
								</span>
								@enderror
							</div>
						</div>
						<div class="row mb-3">
							<label for="nickname" class="col-md-4 col-form-label text-md-end">ニックネーム</label>

							<div class="col-md-6">
								<input id="nickname" type="text" class="form-control @error('nickname') is-invalid @enderror" name="nickname" value="{{ old('nickname',$user->nickname) }}" autocomplete="nickname" autofocus>

								@error('nickname')
								<span class="invalid-feedback" role="alert">
									<strong>{{ $message }}</strong>
								</span>
								@enderror
							</div>
						</div>
						<div class="row mb-3">
							<label for="icon" class="col-md-4 col-form-label text-md-end">アイコン</label>

							<div class="col-md-6">
								<input id="icon" type="file" class="form-control @error('icon') is-invalid @enderror" name="icon" value="{{ old('icon') }}" autofocus>

								@error('icon')
								<span class="invalid-feedback" role="alert">
									<strong>{{ $message }}</strong>
								</span>
								@enderror
							</div>
						</div>

						<div class="row mb-3">
							<label for="password" class="col-md-4 col-form-label text-md-end">パスワード</label>

							<div class="col-md-6">
								<input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password"  autocomplete="new-password">

								@error('password')
								<span class="invalid-feedback" role="alert">
									<strong>{{ $message }}</strong>
								</span>
								@enderror
							</div>
						</div>

						<div class="row mb-3">
							<label for="password-confirm" class="col-md-4 col-form-label text-md-end">パスワード確認</label>

							<div class="col-md-6">
								<input id="password-confirm" type="password" class="form-control" name="password_confirmation"  autocomplete="new-password">
							</div>
						</div>

						<div class="row mb-0">
							<div class="col-md-6 offset-md-4">
								<button type="submit" class="btn btn-primary">
									更新
								</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection