{{--
Template Name: Metronic - Responsive Admin Dashboard Template build with Twitter Bootstrap 4 & Angular 8
Author: KeenThemes
Website: http://www.keenthemes.com/
Contact: support@keenthemes.com
Follow: www.twitter.com/keenthemes
Dribbble: www.dribbble.com/keenthemes
Like: www.facebook.com/keenthemes
Purchase: http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes
Renew Support: http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes
License: You must have a valid license purchased only from themeforest(the above link) in order to legally use the theme for your project.
 --}}
		<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" {{ Metronic::printAttrs('html') }} {{ Metronic::printClasses('html') }}>
<head>


	<meta charset="utf-8"/>

	{{-- Title Section --}}
	<title>{{ config('app.name') }} | @yield('title', $page_title ?? '')</title>

	{{-- Meta Data --}}
	<meta name="description" content="@yield('page_description', $page_description ?? '')"/>
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>

	{{-- Favicon --}}
	<link rel="shortcut icon" href="{{ asset('media/logos/favicon.ico') }}"/>

	{{-- Fonts --}}
	{{ Metronic::getGoogleFontsInclude() }}
	<style>
		.login.login-4 .login-container .login-content {
			width: 450px
		}

		.login.login-4 .login-container .login-content .wizard-nav {
			padding: 0
		}

		.login.login-4 .login-container .login-content .wizard-nav .wizard-steps {
			display: -webkit-box;
			display: -ms-flexbox;
			display: flex;
			-webkit-box-align: center;
			-ms-flex-align: center;
			align-items: center
		}

		.login.login-4 .login-container .login-content .wizard-nav .wizard-steps .wizard-step {
			padding: .75rem 0;
			-webkit-transition: color .15s ease, background-color .15s ease, border-color .15s ease, -webkit-box-shadow .15s ease;
			transition: color .15s ease, background-color .15s ease, border-color .15s ease, -webkit-box-shadow .15s ease;
			transition: color .15s ease, background-color .15s ease, border-color .15s ease, box-shadow .15s ease;
			transition: color .15s ease, background-color .15s ease, border-color .15s ease, box-shadow .15s ease, -webkit-box-shadow .15s ease;
			margin-bottom: 1.5rem
		}

		.login.login-4 .login-container .login-content .wizard-nav .wizard-steps .wizard-step .wizard-wrapper {
			display: -webkit-box;
			display: -ms-flexbox;
			display: flex;
			-webkit-box-align: center;
			-ms-flex-align: center;
			align-items: center
		}

		.login.login-4 .login-container .login-content .wizard-nav .wizard-steps .wizard-step .wizard-icon {
			display: -webkit-box;
			display: -ms-flexbox;
			display: flex;
			-webkit-box-align: center;
			-ms-flex-align: center;
			align-items: center;
			-webkit-box-pack: center;
			-ms-flex-pack: center;
			justify-content: center;
			-webkit-transition: color .15s ease, background-color .15s ease, border-color .15s ease, -webkit-box-shadow .15s ease;
			transition: color .15s ease, background-color .15s ease, border-color .15s ease, -webkit-box-shadow .15s ease;
			transition: color .15s ease, background-color .15s ease, border-color .15s ease, box-shadow .15s ease;
			transition: color .15s ease, background-color .15s ease, border-color .15s ease, box-shadow .15s ease, -webkit-box-shadow .15s ease;
			width: 46px;
			height: 46px;
			border-radius: 12px;
			background-color: #f3f6f9;
			margin-right: 1rem
		}

		.login.login-4 .login-container .login-content .wizard-nav .wizard-steps .wizard-step .wizard-icon .wizard-check {
			display: none;
			font-size: 1.4rem
		}

		.login.login-4 .login-container .login-content .wizard-nav .wizard-steps .wizard-step .wizard-icon .wizard-number {
			font-weight: 600;
			color: #3f4254;
			font-size: 1.35rem
		}

		.login.login-4 .login-container .login-content .wizard-nav .wizard-steps .wizard-step .wizard-label {
			display: -webkit-box;
			display: -ms-flexbox;
			display: flex;
			-webkit-box-orient: vertical;
			-webkit-box-direction: normal;
			-ms-flex-direction: column;
			flex-direction: column;
			-webkit-box-pack: center;
			-ms-flex-pack: center;
			justify-content: center
		}

		.login.login-4 .login-container .login-content .wizard-nav .wizard-steps .wizard-step .wizard-label .wizard-title {
			color: #181c32;
			font-weight: 600;
			font-size: 1.24rem
		}

		.login.login-4 .login-container .login-content .wizard-nav .wizard-steps .wizard-step .wizard-label .wizard-desc {
			color: #b5b5c3;
			font-size: .925rem
		}

		.login.login-4 .login-container .login-content .wizard-nav .wizard-steps .wizard-step[data-wizard-state=done] .wizard-icon {
			-webkit-transition: color .15s ease, background-color .15s ease, border-color .15s ease, -webkit-box-shadow .15s ease;
			transition: color .15s ease, background-color .15s ease, border-color .15s ease, -webkit-box-shadow .15s ease;
			transition: color .15s ease, background-color .15s ease, border-color .15s ease, box-shadow .15s ease;
			transition: color .15s ease, background-color .15s ease, border-color .15s ease, box-shadow .15s ease, -webkit-box-shadow .15s ease;
			background-color: #c9f7f5
		}

		.login.login-4 .login-container .login-content .wizard-nav .wizard-steps .wizard-step[data-wizard-state=done] .wizard-icon .wizard-check {
			color: #1bc5bd;
			display: inline-block
		}

		.login.login-4 .login-container .login-content .wizard-nav .wizard-steps .wizard-step[data-wizard-state=done] .wizard-icon .wizard-number {
			display: none
		}

		.login.login-4 .login-container .login-content .wizard-nav .wizard-steps .wizard-step[data-wizard-state=done] .wizard-label .wizard-title {
			color: #b5b5c3
		}

		.login.login-4 .login-container .login-content .wizard-nav .wizard-steps .wizard-step[data-wizard-state=done] .wizard-label .wizard-desc {
			color: #d1d3e0
		}

		.login.login-4 .login-container .login-content .wizard-nav .wizard-steps .wizard-step[data-wizard-state=current] {
			-webkit-transition: color .15s ease, background-color .15s ease, border-color .15s ease, -webkit-box-shadow .15s ease;
			transition: color .15s ease, background-color .15s ease, border-color .15s ease, -webkit-box-shadow .15s ease;
			transition: color .15s ease, background-color .15s ease, border-color .15s ease, box-shadow .15s ease;
			transition: color .15s ease, background-color .15s ease, border-color .15s ease, box-shadow .15s ease, -webkit-box-shadow .15s ease
		}

		.login.login-4 .login-container .login-content .wizard-nav .wizard-steps .wizard-step[data-wizard-state=current] .wizard-icon {
			-webkit-transition: color .15s ease, background-color .15s ease, border-color .15s ease, -webkit-box-shadow .15s ease;
			transition: color .15s ease, background-color .15s ease, border-color .15s ease, -webkit-box-shadow .15s ease;
			transition: color .15s ease, background-color .15s ease, border-color .15s ease, box-shadow .15s ease;
			transition: color .15s ease, background-color .15s ease, border-color .15s ease, box-shadow .15s ease, -webkit-box-shadow .15s ease;
			background-color: #c9f7f5
		}

		.login.login-4 .login-container .login-content .wizard-nav .wizard-steps .wizard-step[data-wizard-state=current] .wizard-icon .wizard-check {
			color: #1bc5bd;
			display: none
		}

		.login.login-4 .login-container .login-content .wizard-nav .wizard-steps .wizard-step[data-wizard-state=current] .wizard-icon .wizard-number {
			color: #1bc5bd
		}

		.login.login-4 .login-container .login-content .wizard-nav .wizard-steps .wizard-step[data-wizard-state=current] .wizard-label .wizard-title {
			color: #181c32
		}

		.login.login-4 .login-container .login-content .wizard-nav .wizard-steps .wizard-step[data-wizard-state=current] .wizard-label .wizard-desc {
			color: #b5b5c3
		}

		.login.login-4 .login-container .login-content.login-content-signup {
			width: 700px
		}

		.login.login-4 .login-aside {
			background: linear-gradient(147.04deg, #ca7b70 .74%, #5a2119 99.61%);
			width: 700px
		}

		.login.login-4 .login-aside .login-conteiner {
			height: 100%
		}

		@media (min-width: 992px) {
			.login.login-4 .login-aside .login-conteiner {
				min-height: 610px !important;
				background-size: 580px
			}
		}

		@media (min-width: 992px) and (max-width: 1399.98px) {
			.login.login-4 .login-aside .login-conteiner {
				min-height: 420px !important;
				background-size: 400px
			}
		}

		@media (max-width: 991.98px) {
			.login.login-4 .login-container .wizard-nav {
				padding: 0;
				-ms-flex-line-pack: center;
				align-content: center
			}

			.login.login-4 .login-container .wizard-nav .wizard-steps .wizard-step {
				margin-bottom: .5rem
			}

			.login.login-4 .login-aside {
				width: 100% !important
			}

			.login.login-4 .login-aside .login-conteiner {
				min-height: 210px !important;
				background-size: 200px
			}
		}

		@media (max-width: 575.98px) {
			.login.login-4 .login-container {
				width: 100%
			}

			.login.login-4 .login-container .wizard-nav .wizard-steps {
				display: -webkit-box;
				display: -ms-flexbox;
				display: flex;
				-webkit-box-orient: vertical;
				-webkit-box-direction: normal;
				-ms-flex-direction: column;
				flex-direction: column
			}

			.login.login-4 .login-container .wizard-nav .wizard-steps .wizard-step {
				width: 100%
			}

			.login.login-4 .login-container .wizard-nav .wizard-steps .wizard-step .wizard-wrapper .svg-icon {
				display: none
			}

			.login.login-4 .login-container .login-content {
				width: 100%
			}

			.login.login-4 .login-container .login-content.login-content-signup {
				width: 100%
			}

			.login.login-4 .login-aside {
				width: 100% !important
			}
		}

		@media (max-width: 1800px) {
			.login.login-4 .login-aside {
				width: 600px
			}
		}
	</style>
	{{-- Global Theme Styles (used by all pages) --}}
	@foreach(config('layout.resources.css') as $style)
		<link href="{{ config('layout.self.rtl') ? asset(Metronic::rtlCssPath($style)) : asset($style) }}"
		      rel="stylesheet" type="text/css"/>
	@endforeach

	{{-- Layout Themes (used by all pages) --}}
	@foreach (Metronic::initThemes() as $theme)
		<link href="{{ config('layout.self.rtl') ? asset(Metronic::rtlCssPath($theme)) : asset($theme) }}"
		      rel="stylesheet" type="text/css"/>
	@endforeach

	{{-- Includable CSS --}}
	@yield('styles')
</head>

<body {{ Metronic::printAttrs('body') }} {{ Metronic::printClasses('body') }}>
@if ($errors->any())
	<div class="text-danger"
	     role="alert">
		<div class="m-alert__text">
			<ul>
				@foreach($errors->all() as $e)
					<li>{{$e}}</li>
				@endforeach
			</ul>
		</div>
	</div>
@endif
@if(session()->has('success'))
	<div class="text-success" style="margin-bottom: 15px;"
	     role="alert">

		<div class="m-alert__text">
			{{session()->get('success')}}
		</div>
	</div>
@endif
{{--@if (config('layout.page-loader.type') != '')--}}
{{--@include('layout.partials._page-loader')--}}
{{--@endif--}}


<script>var HOST_URL = "{{ route('quick-search') }}";</script>

{{-- Global Config (global config for global JS scripts) --}}
<script>
	var KTAppSettings = {!! json_encode(config('layout.js'), JSON_PRETTY_PRINT|JSON_UNESCAPED_SLASHES) !!};
</script>

{{-- Global Theme JS Bundle (used by all pages)  --}}
@foreach(config('layout.resources.js') as $script)
	<script src="{{ asset($script) }}" type="text/javascript"></script>
@endforeach

{{-- Includable JS --}}
@yield('scripts')

</body>
</html>

