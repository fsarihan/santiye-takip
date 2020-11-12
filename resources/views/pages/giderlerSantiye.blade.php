{{-- Extends layout --}}
@extends('layout.default')
<script src="https://momentjs.com/downloads/moment.js" type="text/javascript"></script>
<script src="https://momentjs.com/downloads/moment-with-locales.js" type="text/javascript"></script>
{{-- Content --}}
@section('content')

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
	<script>
		moment.locale('tr');
		let dataSet = [@foreach($odemeler as $gider)["{{$gider['aciklama']}}", "{{$gider['adi']}}", "{{$gider['tutar']}}", "{{$gider['odenen_tutar']}}", moment("{{$gider['created_at']}}").format('LL'), moment("{{$gider['odenecegi_tarih']}}").format('LL'), moment("{{$gider['odendigi_tarih']}}").format('LL'), "{{$gider['tur']}}", parseInt("{{$gider['odeme_turu_id']}}"), "{{$gider['durum']}}", parseInt("{{$gider['odeme_durum_id']}}"), moment("{{$gider['odendigi_tarih']}}").format('LL'), moment("{{$gider['fatura_tarihi']}}").format('LL')],@endforeach];
	</script>
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
