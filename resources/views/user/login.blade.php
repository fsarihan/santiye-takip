<!DOCTYPE html>

<html lang="tr">
<head>
	<meta charset="utf-8"/>
	<title>Giriş Yap</title>
	<meta name="description" content="Login page example">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<!--begin::Fonts -->
	<link rel="stylesheet"
	      href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700|Roboto:300,400,500,600,700">
	<link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css">

	<!--end::Layout Skins -->
	<link rel="shortcut icon" href="assets/media/logos/favicon.ico"/>
</head>

<!-- end::Head -->

<!-- begin::Body -->
<body class="kt-quick-panel--right kt-demo-panel--right kt-offcanvas-panel--right kt-header--fixed kt-header-mobile--fixed kt-subheader--enabled kt-subheader--solid kt-aside--enabled kt-aside--fixed kt-aside--minimize kt-page--loading">

<!-- begin:: Page -->
<div class="kt-grid kt-grid--ver kt-grid--root kt-page">
	<div class="kt-grid kt-grid--hor kt-grid--root  kt-login kt-login--v1" id="kt_login">
		<div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--desktop kt-grid--ver-desktop kt-grid--hor-tablet-and-mobile">

			<!--begin::Aside-->
			<div class="kt-grid__item kt-grid__item--order-tablet-and-mobile-2 kt-grid kt-grid--hor kt-login__aside"
			     style="background-image: url(assets/media/bg/bg-4.jpg);">
				<div class="kt-grid__item">
					<a href="#" class="kt-login__logo">
						<img src="assets/media/logos/logo-4.png">
					</a>
				</div>
				<div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--ver">
					<div class="kt-grid__item kt-grid__item--middle">
						<h3 class="kt-login__title">Hoşgeldiniz!</h3>
						<h4 class="kt-login__subtitle">Şantiye yönetim yazılımını kullanmak için lütfen giriş yapınız.</h4>
					</div>
				</div>
				<div class="kt-grid__item">
					<div class="kt-login__info">
						<div class="kt-login__copyright">
							&copy 2019 fsarihan
						</div>
						<div class="kt-login__menu">
							<a href="#" class="kt-link">Privacy</a>
							<a href="#" class="kt-link">Legal</a>
							<a href="#" class="kt-link">Contact</a>
						</div>
					</div>
				</div>
			</div>

			<!--begin::Aside-->

			<!--begin::Content-->
			<div class="kt-grid__item kt-grid__item--fluid  kt-grid__item--order-tablet-and-mobile-1  kt-login__wrapper">

				<!--begin::Head-->
			{{--<div class="kt-login__head">--}}
			{{--<span class="kt-login__signup-label">Don't have an account yet?</span>&nbsp;&nbsp;--}}
			{{--<a href="#" class="kt-link kt-login__signup-link">Sign Up!</a>--}}
			{{--</div>--}}

			<!--end::Head-->

				<!--begin::Body-->
				<div class="kt-login__body">

					<!--begin::Signin-->
					<div class="kt-login__form">
						<div class="kt-login__title">
							<h3>Giriş Yap</h3>
						</div>


						@if ($errors->any())

							@foreach($errors->all() as $e)
								<div class="alert alert-warning fade show" role="alert">
									<div class="alert-icon"><i class="flaticon-warning"></i></div>
									<div class="alert-text">{{$e}}</div>
									<div class="alert-close">
										<button type="button" class="close" data-dismiss="alert" aria-label="Close">
											<span aria-hidden="true"><i class="la la-close"></i></span>
										</button>
									</div>
								</div>
							@endforeach


						@endif
						@if(session()->has('success'))
							<div class="text-success" style="margin-bottom: 15px;"
							     role="alert">

								<div class="m-alert__text">
									{{session()->get('success')}}
								</div>
							</div>
					@endif
					@yield("content")


					<!--begin::Form-->
						<form class="kt-form" action="{{route("user.loginPost")}}" method="POST" novalidate="novalidate"
						      id="kt_login_form">
							@csrf
							<div class="form-group">
								<input class="form-control" type="text" placeholder="E-Mail" name="email"
								       autocomplete="off">
							</div>
							<div class="form-group">
								<input class="form-control" type="password" placeholder="Parola" name="password"
								       autocomplete="off">
							</div>

							<!--begin::Action-->
							<div class="kt-login__actions">
								{{--<a href="#" class="kt-link kt-login__link-forgot">--}}
								{{--Forgot Password ?--}}
								{{--</a>--}}
								<button id="kt_login_signin_submit"
								        class="btn btn-primary btn-elevate kt-login__btn-primary">Giriş
								</button>
							</div>

							<!--end::Action-->
						</form>

						<!--end::Form-->

						<!--begin::Divider-->


						<!--end::Divider-->

						<!--begin::Options-->


						<!--end::Options-->
					</div>

					<!--end::Signin-->
				</div>

				<!--end::Body-->
			</div>

			<!--end::Content-->
		</div>
	</div>
</div>

<!-- end:: Page -->

<!-- begin::Global Config(global config for global JS sciprts) -->
<script>
	var KTAppOptions = {
		"colors": {
			"state": {
				"brand": "#22b9ff",
				"light": "#ffffff",
				"dark": "#282a3c",
				"primary": "#5867dd",
				"success": "#34bfa3",
				"info": "#36a3f7",
				"warning": "#ffb822",
				"danger": "#fd3995"
			},
			"base": {
				"label": ["#c5cbe3", "#a1a8c3", "#3d4465", "#3e4466"],
				"shape": ["#f0f3ff", "#d9dffa", "#afb4d4", "#646c9a"]
			}
		}
	};
</script>

<!-- end::Global Config -->

<!--begin::Global Theme Bundle(used by all pages) -->
<script src="{{ asset('js/app.js') }}"></script>


<!--end::Page Scripts -->
</body>

<!-- end::Body -->
</html>