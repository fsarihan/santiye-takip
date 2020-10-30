@extends('layout.login')


<body id="kt_body"
      class="header-fixed header-mobile-fixed subheader-enabled subheader-fixed aside-enabled aside-fixed aside-minimize-hoverable page-loading">

<div class="d-flex flex-column flex-root">

	<div class="login login-4 wizard d-flex flex-column flex-lg-row flex-column-fluid">

		<div class="login-container order-2 order-lg-1 d-flex flex-center flex-row-fluid px-7 pt-lg-0 pb-lg-0 pt-4 pb-6 bg-white">

			<div class="login-content d-flex flex-column pt-lg-0 pt-12">

				{{--<a href="#" class="login-logo pb-xl-20 pb-15">--}}

				{{--<img src="{{ asset('media/logos/logo-4.png') }}"--}}
				{{--class="max-h-70px" alt=""/>--}}
				{{--</a>--}}

				<div class="login-form">

					<form class="form" id="kt_login_singin_form" method="post" action="{{route("user.registerPost")}}">
						@csrf
						<div class="pb-5 pb-lg-15">
							<h3 class="font-weight-bolder text-dark font-size-h2 font-size-h1-lg">Giriş Yap</h3>

						</div>
						<div class="form-group">
							<label class="font-size-h6 font-weight-bolder text-dark">İsim</label>
							<input class="form-control form-control-solid h-auto py-7 px-6 rounded-lg border-0"
							       type="text" name="name" autocomplete="off"/>
						</div>
						<div class="form-group">
							<label class="font-size-h6 font-weight-bolder text-dark">Mail Adresi</label>
							<input class="form-control form-control-solid h-auto py-7 px-6 rounded-lg border-0"
							       type="text" name="email" autocomplete="off"/>
						</div>

						<div class="form-group">
							<div class="d-flex justify-content-between mt-n5">
								<label class="font-size-h6 font-weight-bolder text-dark pt-5">Parola</label>
								<a href="#"
								   class="text-primary font-size-h6 font-weight-bolder text-hover-primary pt-5">Parolanızı mı unuttunuz?</a>
							</div>
							<input class="form-control form-control-solid h-auto py-7 px-6 rounded-lg border-0"
							       type="password" name="password" autocomplete="off"/>
						</div>

						<div class="pb-lg-0 pb-5">
							<button type="submit" id="kt_login_singin_form_submit_button"
							        class="btn btn-primary font-weight-bolder font-size-h6 px-8 py-4 my-3 mr-3">GİRİŞ
							</button>

						</div>

					</form>

				</div>

			</div>
		</div>

		<div class="login-aside order-1 order-lg-2 bgi-no-repeat bgi-position-x-right">
			<div class="login-conteiner bgi-no-repeat bgi-position-x-right bgi-position-y-bottom"

			     style="background-image: url({{asset("media/svg/illustrations/login-visual-4.svg")}});">
				<h4 class="pt-lg-40 pl-lg-20 pb-lg-0 pl-10 py-20 m-0 d-flex justify-content-lg-start font-weight-boldest display5 display1-lg text-white">Şantiye Yönetimi
					<br/>Uygulaması
				</h4>

			</div>
		</div>

	</div>

</div>
