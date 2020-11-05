{{-- Extends layout --}}
@extends('layout.default')

{{-- Content --}}
@section('content')

	<div class="card card-custom card-stretch gutter-b">

		<div class="card-header border-0 pt-5">
			<h3 class="card-title align-items-start flex-column">
				<span class="card-label font-weight-bolder text-dark">Kullanıcı Tipleri Listesi</span>
				<span class="text-muted mt-3 font-weight-bold font-size-sm">Yetki tiplerini görüntüleyin ve düzenleyin.</span>
			</h3>
			<div class="card-toolbar">
				<ul class="nav nav-pills nav-pills-sm nav-dark-75">
					<li class="nav-item">
						<button type="button" class="btn btn-primary">Yeni Kullanıcı Tipi Ekle</button>
					</li>
				</ul>
			</div>
		</div>

		<div class="card-body">


			<div class="bootstrap-switch bootstrap-switch-wrapper bootstrap-switch-focused bootstrap-switch-animate bootstrap-switch-on"
			     style="width: 194px;">
				<div class="bootstrap-switch-container" style="width: 288px; margin-left: 0px;"><span
							class="bootstrap-switch-handle-on bootstrap-switch-primary"
							style="width: 96px;">Enabled</span><span class="bootstrap-switch-label"
				                                                     style="width: 96px;">&nbsp;</span><span
							class="bootstrap-switch-handle-off bootstrap-switch-default"
							style="width: 96px;">Disabled</span><input data-switch="true" type="checkbox"
				                                                       checked="checked" data-on-text="Enabled"
				                                                       data-handle-width="70" data-off-text="Disabled"
				                                                       data-on-color="primary"></div>
			</div>
			<div class="bootstrap-switch bootstrap-switch-wrapper bootstrap-switch-focused bootstrap-switch-animate bootstrap-switch-on"
			     style="width: 194px;">
				<div class="bootstrap-switch-container" style="width: 288px; margin-left: 0px;"><span
							class="bootstrap-switch-handle-on bootstrap-switch-primary"
							style="width: 96px;">Enabled</span><span class="bootstrap-switch-label"
				                                                     style="width: 96px;">&nbsp;</span><span
							class="bootstrap-switch-handle-off bootstrap-switch-default"
							style="width: 96px;">Disabled</span><input data-switch="true" type="checkbox"
				                                                       checked="checked" data-on-text="Enabled"
				                                                       data-handle-width="70" data-off-text="Disabled"
				                                                       data-on-color="primary"></div>
			</div>

		</div>
	</div>

@endsection

{{-- Styles Section --}}
@section('styles')
	<link href="{{ asset('plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css"/>
@endsection


{{-- Scripts Section --}}
@section('scripts')
	{{-- vendors --}}
	<script src="{{ asset('plugins/custom/datatables/datatables.bundle.js') }}" type="text/javascript"></script>

	{{-- page scripts --}}
	<script src="{{ asset('js/app.js') }}" type="text/javascript"></script>
@endsection
