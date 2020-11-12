{{-- Extends layout --}}
@extends('layout.default')
{{-- Content --}}
@section('content')
	<div class="row">
		<div class="col-xl-4">
			<!--begin::Stats Widget 22-->
			<div class="card card-custom bgi-no-repeat card-stretch gutter-b"
			     style="background-position: right top; background-size: 30% auto; background-image: url(/media/svg/shapes/abstract-3.svg)">
				<!--begin::Body-->
				<div class="card-body my-4">
					<a href="#"
					   class="card-title font-weight-bolder text-info font-size-h6 mb-4 text-hover-state-dark d-block">Toplam Gider</a>
					<div class="font-weight-bold text-muted font-size-sm">
						<span class="text-dark-75 font-weight-bolder font-size-h2 mr-2">3.543.234,00</span>TL
					</div>

				</div>
				<!--end::Body-->
			</div>
			<!--end::Stats Widget 22-->
		</div>
		<div class="col-xl-4">
			<!--begin::Stats Widget 23-->
			<div class="card card-custom bg-success bgi-no-repeat card-stretch gutter-b"
			     style="background-position: right top; background-size: 30% auto; background-image: url(/media/svg/shapes/abstract-1.svg)">
				<!--begin::Body-->
				<div class="card-body my-4">
					<a href="#"
					   class="card-title font-weight-bolder text-white font-size-h6 mb-4 text-hover-state-dark d-block">Toplam Ödenen Gider</a>
					<div class="font-weight-bold text-white font-size-sm">
						<span class="font-size-h2 mr-2">86.000,20</span>TL
					</div>

				</div>
				<!--end::Body-->
			</div>
			<!--end::Stats Widget 23-->
		</div>
		<div class="col-xl-4">
			<!--begin::Stats Widget 24-->
			<div class="card card-custom bg-primary bgi-no-repeat card-stretch gutter-b"
			     style=" background-position: right top; background-size: 30% auto; background-image: url(/media/svg/shapes/abstract-2.svg)">
				<!--begin::Body-->
				<div class="card-body my-4">
					<a href="#"
					   class="card-title font-weight-bolder text-white font-size-h6 mb-4 text-hover-state-dark d-block">Toplam Ödenecek Gider</a>
					<div class="font-weight-bold text-white font-size-sm">
						<span class="font-size-h2 mr-2">2.443.111,45</span>TL
					</div>

				</div>
				<!--end::Body-->
			</div>
			<!--end::Stats: Widget 24-->
		</div>
	</div>
	<div class="card card-custom">
		<div class="card-header flex-wrap border-0 pt-6 pb-0">
			<div class="card-title">
				<h3 class="card-label">Şantiye Giderleri
					<div class="text-muted pt-2 font-size-sm">Şantiye giderlerinizi inceleyebilir, düzenleyebilir veya silebilirsiniz..</div>
				</h3>
			</div>
			<div class="card-toolbar">
				<a href="{{route('panel.santiyeGideriEkle')}}"
				   class="btn btn-light-primary font-weight-bold mr-2">Hızlı Gider Ekle</a>
				<a href="{{route('panel.santiyeGideriEkle')}}"
				   class="btn btn-light-primary font-weight-bold mr-2" disabled>Detaylı Gider Ekle</a>
			</div>
		</div>
		<div class="card-body">
			<table class="table table-separate table-head-custom" id="kt_datatable"></table>
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
	<script src="https://momentjs.com/downloads/moment.js" type="text/javascript"></script>
	<script src="https://momentjs.com/downloads/moment-with-locales.js" type="text/javascript"></script>
	<script src="{{ asset('plugins/custom/datatables/datatables.bundle.js') }}" type="text/javascript"></script>
	<script>
		moment.locale('tr');
		let dataSet = [];
		@foreach($odemeler as $gider)
		dataSet.push(["{{$gider['aciklama']}}", "{{$gider['adi']}}", "{{$gider['tutar']}}", "{{$gider['odenen_tutar']}}", moment("{{$gider['created_at']}}").format('LLL'), moment("{{$gider['odenecegi_tarih']}}").format('LL'), moment("{{$gider['odendigi_tarih']}}").format('LL'), "{{$gider['tur']}}", parseInt("{{$gider['odeme_turu_id']}}"), "{{$gider['durum']}}", parseInt("{{$gider['odeme_durum_id']}}"), moment("{{$gider['odendigi_tarih']}}").format('LL'), moment("{{$gider['fatura_tarihi']}}").format('LL'), moment("{{$gider['odenecegi_tarih']}}").format('LL')]);
		@endforeach

	</script>
	<script src="{{ asset('js/app.js') }}" type="text/javascript"></script>
@endsection
