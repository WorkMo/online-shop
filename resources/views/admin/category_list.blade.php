@extends('layouts.admin')

@section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-9">
			<div class="card mb-5">
				<div class="card-header">カテゴリー登録</div>
				<form method="POST" action="{{ route('category_register') }}">
					@csrf
					<div class="row mb-3 mt-5 mb-5">
						<label for="category_name" class="col-md-4 col-form-label text-md-end">カテゴリー名</label>
						<div class="col-md-6 ">
							<div class=" d-flex flex-flow"><input id="category_name" type="text" class="form-control @error('category_name') is-invalid @enderror" name="category_name" value="{{ old('category_name') }}" placeholder="" required autocomplete="" autofocus>
								<button type="submit" class="btn btn-primary text-nowrap">
									登録
								</button>
							</div>
							@error('category_name')
							<span class="invalid-feedback d-block" role="alert">
								<strong>{{ $message }}</strong>
							</span>
							@enderror
						</div>
					</div>
				</form>
			</div>
			<div class="card">
				<div class="card-header">カテゴリー一覧</div>
				<table class="table table-striped table-bordered mb-0">
					<tr class="text-center align-middle">
						<th> カテゴリー名</th>
						<th>編集</th>
						<th>削除</th>
					</tr>
					@if($categories->isEmpty())
					<tr class="text-center align-middle border-bottom-0">
						<td colspan="10">カテゴリーが登録されていません。</td>
					</tr>
					@else
					@foreach($categories as $category)
					<tr class="text-center align-middle">
						<td>{{$category->category_name}}</td>
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