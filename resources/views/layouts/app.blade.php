<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- CSRF Token -->
	<meta name="csrf-token" content="{{ csrf_token() }}">

	<title>{{ config('app.name', 'Laravel') }}</title>

	<!-- Fonts -->
	<link rel="dns-prefetch" href="//fonts.gstatic.com">
	<link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
	<!-- Scripts -->
	@vite(['resources/sass/app.scss', 'resources/js/app.js','resources/css/app.css'])
</head>

<body>
	<div id="app">
		<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
			<div class="container">
				<a class="navbar-brand" href="{{ url('/') }}">
					{{ config('app.name', 'Laravel') }}
				</a>
				<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
					<span class="navbar-toggler-icon"></span>
				</button>

				<div class="collapse navbar-collapse" id="navbarSupportedContent">
					<!-- Left Side Of Navbar -->
					<ul class="navbar-nav me-auto">

					</ul>

					<!-- Right Side Of Navbar -->
					<ul class="navbar-nav ms-auto">
						<!-- Authentication Links -->
						@auth
						<li class="nav-item my-auto d-flex flex-row gap-2 me-2 ">
							<a href="{{route('cart')}}" class="nav-link my-auto text-center">
								<svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-cart4" viewBox="0 0 16 16">
									<path d="M0 2.5A.5.5 0 0 1 .5 2H2a.5.5 0 0 1 .485.379L2.89 4H14.5a.5.5 0 0 1 .485.621l-1.5 6A.5.5 0 0 1 13 11H4a.5.5 0 0 1-.485-.379L1.61 3H.5a.5.5 0 0 1-.5-.5zM3.14 5l.5 2H5V5H3.14zM6 5v2h2V5H6zm3 0v2h2V5H9zm3 0v2h1.36l.5-2H12zm1.11 3H12v2h.61l.5-2zM11 8H9v2h2V8zM8 8H6v2h2V8zM5 8H3.89l.5 2H5V8zm0 5a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0zm9-1a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0z" />
								</svg>
								<span class="d-block">カート</span>
							</a>
							<a href="{{route('watch_list')}}" class="nav-link my-auto text-center">
								<svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-bookmark-star-fill" viewBox="0 0 16 16">
									<path fill-rule="evenodd" d="M2 15.5V2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v13.5a.5.5 0 0 1-.74.439L8 13.069l-5.26 2.87A.5.5 0 0 1 2 15.5zM8.16 4.1a.178.178 0 0 0-.32 0l-.634 1.285a.178.178 0 0 1-.134.098l-1.42.206a.178.178 0 0 0-.098.303L6.58 6.993c.042.041.061.1.051.158L6.39 8.565a.178.178 0 0 0 .258.187l1.27-.668a.178.178 0 0 1 .165 0l1.27.668a.178.178 0 0 0 .257-.187L9.368 7.15a.178.178 0 0 1 .05-.158l1.028-1.001a.178.178 0 0 0-.098-.303l-1.42-.206a.178.178 0 0 1-.134-.098L8.16 4.1z" />
								</svg>
								<span class="d-block">お気に入り</span>
							</a>
							<a href="{{route('order_history')}}" class="nav-link my-auto text-center">
								<svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-bag-check" viewBox="0 0 16 16">
									<path fill-rule="evenodd" d="M10.854 8.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 0 1 .708-.708L7.5 10.793l2.646-2.647a.5.5 0 0 1 .708 0z" />
									<path d="M8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1zm3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4h-3.5zM2 5h12v9a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V5z" />
								</svg>
								<span class="d-block">購入履歴</span>
							</a>
							<a href="{{route('review_list')}}" class="nav-link my-auto text-center">
								<svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-chat-text" viewBox="0 0 16 16">
									<path d="M2.678 11.894a1 1 0 0 1 .287.801 10.97 10.97 0 0 1-.398 2c1.395-.323 2.247-.697 2.634-.893a1 1 0 0 1 .71-.074A8.06 8.06 0 0 0 8 14c3.996 0 7-2.807 7-6 0-3.192-3.004-6-7-6S1 4.808 1 8c0 1.468.617 2.83 1.678 3.894zm-.493 3.905a21.682 21.682 0 0 1-.713.129c-.2.032-.352-.176-.273-.362a9.68 9.68 0 0 0 .244-.637l.003-.01c.248-.72.45-1.548.524-2.319C.743 11.37 0 9.76 0 8c0-3.866 3.582-7 8-7s8 3.134 8 7-3.582 7-8 7a9.06 9.06 0 0 1-2.347-.306c-.52.263-1.639.742-3.468 1.105z" />
									<path d="M4 5.5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5zM4 8a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7A.5.5 0 0 1 4 8zm0 2.5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4a.5.5 0 0 1-.5-.5z" />
								</svg>
								<span class="d-block">投稿一覧</span>
							</a>
							<a href="{{route('review_like_list')}}" class="nav-link my-auto text-center">
								<svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-chat-heart" viewBox="0 0 16 16">
									<path fill-rule="evenodd" d="M2.965 12.695a1 1 0 0 0-.287-.801C1.618 10.83 1 9.468 1 8c0-3.192 3.004-6 7-6s7 2.808 7 6c0 3.193-3.004 6-7 6a8.06 8.06 0 0 1-2.088-.272 1 1 0 0 0-.711.074c-.387.196-1.24.57-2.634.893a10.97 10.97 0 0 0 .398-2Zm-.8 3.108.02-.004c1.83-.363 2.948-.842 3.468-1.105A9.06 9.06 0 0 0 8 15c4.418 0 8-3.134 8-7s-3.582-7-8-7-8 3.134-8 7c0 1.76.743 3.37 1.97 4.6a10.437 10.437 0 0 1-.524 2.318l-.003.011a10.722 10.722 0 0 1-.244.637c-.079.186.074.394.273.362a21.673 21.673 0 0 0 .693-.125ZM8 5.993c1.664-1.711 5.825 1.283 0 5.132-5.825-3.85-1.664-6.843 0-5.132Z" />
								</svg>
								<span class="d-block">いいね一覧</span>
							</a>
							<a href="{{route('user_info')}}" class="nav-link my-auto text-center">
								<img src="{{asset(Auth::user()->icon)}}" alt="マイページ" class="rounded-circle border border-secondary object-fit-cover" style="width: 30px;">
								<span class="d-block">マイページ</span>
							</a>
						</li>
						@if(Auth::user()->admin==1||Auth::user()->seller==1)
						<li class="nav-item my-auto dropdown">
							<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
								利用者ページ
							</a>
							<ul class="dropdown-menu" aria-labelledby="navbarDropdown">
								@if(Auth::user()->seller==1)
								<li><a class="dropdown-item" href="{{route('seller_index')}}">販売者ページ</a></li>
								@endif
								@if(Auth::user()->admin==1)
								<li><a class="dropdown-item" href="{{route('admin_index')}}">管理者ページ</a></li>
								@endif
							</ul>
						</li>
						@endif
						@endauth
						@guest
						@if (Route::has('login'))
						<li class="nav-item my-auto">
							<a class="nav-link" href="{{ route('login') }}">ログイン</a>
						</li>
						@endif

						@if (Route::has('register'))
						<li class="nav-item my-auto">
							<a class="nav-link" href="{{ route('register') }}">新規登録</a>
						</li>
						@endif
						@else
						<li class="nav-item my-auto dropdown">
							<a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
								{{ Auth::user()->user_name }}さん
							</a>

							<div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
								<a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                    document.getElementById('logout-form').submit();">
									<svg version="1.1" id="_x32_" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512 512" style="width: 30px; height: 30px; opacity: 1;" xml:space="preserve">
										<g>
											<path class="st0" d="M319.982,142.443c21.826,0,39.521-17.702,39.521-39.529c0-21.828-17.694-39.529-39.521-39.529c-21.827,0-39.522,17.701-39.522,39.529C280.46,124.741,298.154,142.443,319.982,142.443z" style="fill: rgb(75, 75, 75);">
											</path>
											<path class="st0" d="M503.418,398.064l-58.11-37.147l-46.814-73.562l-15.413-86.966l50.138-4.654l43.149,27.914c5.799,3.737,13.459,2.686,18.005-2.506l0.248-0.296c5.044-5.745,4.515-14.479-1.206-19.562l-38.618-34.328c-4.164-3.698-9.489-5.83-15.062-6.049l-96.354-5.363c-2.973-0.171-5.737,0.054-5.737,0.054c-1.238,0.101-2.491,0.264-3.737,0.459c-7.021,1.207-13.327,4.118-18.566,8.213l-70.86,42.79l-44.628-24.98c-6.92-3.877-15.678-1.573-19.803,5.215l-0.553,0.926c-2.039,3.37-2.662,7.395-1.72,11.217c0.957,3.799,3.378,7.084,6.764,9.092l53.182,31.744c6.609,3.954,14.681,4.671,21.898,1.946l44.876-16.97l14.93,60.242l-63.021-0.242c-8.376-0.031-16.308,3.69-21.641,10.12c-5.34,6.452-7.496,14.938-5.908,23.15l16.697,86c1.853,9.528,10.875,15.903,20.473,14.464l0.716-0.109c9.505-1.424,16.231-9.995,15.359-19.57l-5.652-61.621l87.698,2.772l41.078,41.404c5.722,5.753,12.26,10.673,19.39,14.565l61.022,33.317c8.554,4.428,19.072,1.261,23.757-7.146l0.343-0.576C514.41,413.616,511.622,403.046,503.418,398.064z" style="fill: rgb(75, 75, 75);">
											</path>
											<polygon class="st0" points="122.898,108.534 41.194,52.736 250.063,52.736 250.063,20.852 0,20.852 0,435.35 41.194,435.35122.898,491.148 122.898,475.206 122.898,435.35 222.522,435.35 222.522,403.466 122.898,403.466" style="fill: rgb(75, 75, 75);"></polygon>
										</g>
									</svg>
									ログアウト </a>

								<form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
									@csrf
								</form>
							</div>
						</li>
						@endguest
					</ul>
				</div>
			</div>
		</nav>

		<main class="py-4">
			@yield('content')
		</main>
	</div>
</body>

</html>