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
						<div class="nav-item my-auto d-flex flex-row  gap-2 me-2 ">
							@if(Auth::user()->admin==1)

							<li class="nav-item"></li>
							<a href="{{route('category_form')}}" class="nav-link my-auto text-center">
								<svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-tags" viewBox="0 0 16 16">
									<path d="M3 2v4.586l7 7L14.586 9l-7-7H3zM2 2a1 1 0 0 1 1-1h4.586a1 1 0 0 1 .707.293l7 7a1 1 0 0 1 0 1.414l-4.586 4.586a1 1 0 0 1-1.414 0l-7-7A1 1 0 0 1 2 6.586V2z" />
									<path d="M5.5 5a.5.5 0 1 1 0-1 .5.5 0 0 1 0 1zm0 1a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3zM1 7.086a1 1 0 0 0 .293.707L8.75 15.25l-.043.043a1 1 0 0 1-1.414 0l-7-7A1 1 0 0 1 0 7.586V3a1 1 0 0 1 1-1v5.086z" />
								</svg>
								<span class="d-block">商品カテゴリー</span>
							</a>
							<li class="nav-item">
								<a href="{{route('seller_request_list')}}" class="nav-link my-auto text-center">
									<svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-person-plus" viewBox="0 0 16 16">
										<path d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H1s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C9.516 10.68 8.289 10 6 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z" />
										<path fill-rule="evenodd" d="M13.5 5a.5.5 0 0 1 .5.5V7h1.5a.5.5 0 0 1 0 1H14v1.5a.5.5 0 0 1-1 0V8h-1.5a.5.5 0 0 1 0-1H13V5.5a.5.5 0 0 1 .5-.5z" />
									</svg>
									<span class="d-block">販売者申請</span>
								</a>
							</li>

							@endif
						</div>
						@auth
						@if(Auth::user()->admin==1||Auth::user()->seller==1)
						<li class="nav-item my-auto dropdown">
							<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
								管理者ページ
							</a>
							<ul class="dropdown-menu" aria-labelledby="navbarDropdown">
								<li><a class="dropdown-item" href="{{route('index')}}">利用者ページ</a></li>
								@if(Auth::user()->seller==1)
								<li><a class="dropdown-item" href="{{route('seller_index')}}">販売者ページ</a></li>
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
									ログアウト
								</a>

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