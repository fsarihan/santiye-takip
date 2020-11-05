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


			<table class="table table-bordered table-hover" id="calisan_maaslar">
				<thead>
				<tr>
					<th>Kullanıcı Profili</th>
					<th>Kayıtlı Kullanıcı Sayısı</th>
					<th>Oluşturan Kişi</th>
					<th>Yetkiler</th>
				</tr>
				</thead>
				<tbody>
				@foreach($kullaniciTipleri as $kullaniciTipi)
					<tr>
						<td>{{$kullaniciTipi['adi']->adi}}</td>
						<td>NaN</td>
						<td>{{$kullaniciTipi['olusturan_id']}}</td>
						<td>{{$kullaniciTipi['yevmiye']}}</td>
					</tr>
				@endforeach
				</tbody>
			</table>

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
