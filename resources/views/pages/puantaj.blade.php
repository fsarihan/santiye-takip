{{-- Extends layout --}}
@extends('layout.default')

{{-- Content --}}
@section('content')
	<div class="card card-custom">
		<div class="card-header">
			<div class="card-title">
				<h3 class="card-label">
					Puantaj Tablosu
				</h3>
			</div>
			<button type="button" id="xxxx" class="btn btn-danger" hidden="true" disabled="true">
				GEÇERSİZ TARİH
			</button>
			<button type="button" id="yevmiyeDuzenle" class="btn btn-warning" data-toggle="modal"
			        data-target="#exampleModal" hidden="true">
				Yevmiye Düzenle
			</button>
			<button type="button" id="yevmiyeEkle" class="btn btn-primary" data-toggle="modal"
			        data-target="#exampleModal">
				Yevmiye Ekle
			</button>
		</div>
		<div class="card-body">
			<div id="kt_calendar"></div>
		</div>
	</div>

	<div class="modal fade" id="exampleModal" data-backdrop="static" tabindex="-1" role="dialog"
	     aria-labelledby="staticBackdrop" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<form action="{{action('PagesController@puantajPost') }}" method="POST">
					@CSRF
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">x</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<i aria-hidden="true" class="ki ki-close"></i>
						</button>
					</div>
					<div class="modal-body">

						<input type="hidden" id="seciliGun" name="seciliGun">
						<input type="hidden" id="santiyeID" name="santiyeID" value="{{$seciliSantiye['id']}}">
						<table class="table table-bordered table-hover" id="kt_datatable">
							<thead>
							<tr>
								<th>Adı Soyadı</th>
								<th>Çalışma Durumu</th>
								<th>Yevmiye</th>
							</tr>
							</thead>
							<tbody>
							@foreach($isciler as $isci)
								<tr>
									<td>{{$isci['adi']}}</td>
									<td>Çalışıyor.</td>
									{{--TODO: Çalışma durumuyla ilgili çalışma yap.--}}
									<td>
										<div class="dropdown bootstrap-select form-control">
											<select name="calisanYevmiye[]" class="form-control selectpicker">
												<option value="{{$isci['id']}}|0">Çalışma yok</option>
												<option value="{{$isci['id']}}|1">Tam gün yevmiye</option>
												<option value="{{$isci['id']}}|1.5">1.5 gün yevmiye</option>
												<option value="{{$isci['id']}}|0.5">Yarım gün yevmiye</option>
												<option value="{{$isci['id']}}|2">Çift yevmiye</option>
											</select>
										</div>
									</td>
								</tr>
							@endforeach

							</tbody>
						</table>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-light-primary font-weight-bold"
						        data-dismiss="modal">Kapat
						</button>
						<button type="submit" class="btn btn-primary font-weight-bold">Kaydet</button>
					</div>
				</form>
			</div>
		</div>
	</div>
@endsection


@section('styles')
	<link href="{{ asset('plugins/custom/fullcalendar/fullcalendar.bundle.css') }}" rel="stylesheet"
	      type="text/css"/>
	<link href="{{ asset('plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet"
	      type="text/css"/>
@endsection

@section('scripts')
	<script src="{{ asset('plugins/custom/fullcalendar/fullcalendar.bundle.js') }}"
	        type="text/javascript"></script>
	<script src="{{ asset('plugins/custom/datatables/datatables.bundle.js') }}" type="text/javascript"></script>

	<script src="{{ asset('js/app.js') }}" type="text/javascript"></script>
	<script>


		jQuery(document).ready(function () {
			var todayDate = moment().startOf('day');
			var YM = todayDate.format('YYYY-MM');
			var YESTERDAY = todayDate.clone().subtract(1, 'day').format('YYYY-MM-DD');
			var TODAY = todayDate.format('YYYY-MM-DD');
			var TOMORROW = todayDate.clone().add(1, 'day').format('YYYY-MM-DD');
			var calendarEl = document.getElementById('kt_calendar');


			var calendar = new FullCalendar.Calendar(calendarEl, {
				locale: 'tr',
				plugins: ['bootstrap', 'interaction', 'dayGrid', 'timeGrid', 'list'],
				themeSystem: 'bootstrap',
				header: {
					left: 'prev,next today, addEventButton',
					center: 'title',
					right: 'dayGridMonth, dayGridDay'
				},

				height: 1200,
				contentHeight: 1000,
				aspectRatio: 2,  // see: https://fullcalendar.io/docs/aspectRatio

				nowIndicator: true,
				now: TODAY + 'T09:25:00', // just for demo

				views: {
					dayGridMonth: {buttonText: 'Ay Görünümü'},
					timeGridWeek: {buttonText: 'week'},
					timeGridDay: {buttonText: 'Gün Görünümü'},
					dayGridDay: {buttonText: 'Gün Görünümü'}
				},

				defaultView: 'dayGridMonth',
				defaultDate: TODAY,

				editable: true,
				eventLimit: true, // allow "more" link when too many events
				navLinks: true,
				eventRender: function (info) {

					var element = $(info.el);
					if (info.event.extendedProps && info.event.extendedProps.description) {
						if (element.hasClass('fc-day-grid-event')) {
							element.data('content', info.event.extendedProps.description);
							element.data('placement', 'top');
							KTApp.initPopover(element);
						} else if (element.hasClass('fc-time-grid-event')) {
							element.find('.fc-title').append('<div class="fc-description">' + info.event.extendedProps.description + '</div>');
						} else if (element.find('.fc-list-item-title').lenght !== 0) {
							element.find('.fc-list-item-title').append('<div class="fc-description">' + info.event.extendedProps.description + '</div>');
						}
					}
				},
				events: [
						@foreach($puantaj as $yevmiye)
						@if($yevmiye["puan"] > 0)
					{
						title: '{{collect($isciler)->where('id', $yevmiye["isci_id"])->first()['adi']}}',
						start: moment('{{$yevmiye["tarih"]}}').format('YYYY-MM-DD'),
						description: '{{$yevmiye["puan"]}}' + ' günlük çalıma',
						className: "fc-event-solid-{{$yevmiye['class']}}"
					},
					@endif
					@endforeach

				]
			});

			calendar.render();
			moment.locale('tr');
			$('#yevmiyeEkle').click(function () {
				$('#exampleModalLabel').text(moment(calendar.getDate()).format('LL') + " Tarihi İçin Puantaj Ekle");
			});
			$('#yevmiyeDuzenle').click(function () {
				//TODO: yeni modal oluştur, düzenleme işlerini bitir.
				$('#exampleModalLabel2').text(moment(calendar.getDate()).format('LL') + " Tarihi İçin Puantaj Ekle");
			});
			setInterval(function () {
				var events = calendar.getEvents();
				var eventStarts = events.map(function (event) {
					return moment(event.start).format('YYYYMMDD');
				});
				if (moment(TODAY).format('YYYYMMDD') < moment(calendar.getDate()).format('YYYYMMDD')) {
					$('#yevmiyeEkle').prop('hidden', true);
					$('#yevmiyeDuzenle').prop('hidden', true);
					$('#xxxx').prop('hidden', false);

				} else {
					$('#xxxx').prop('hidden', true);
					$('#yevmiyeEkle').prop('hidden', false);
					$('#seciliGun').val(moment(calendar.getDate()).format());
				}
				if (eventStarts.indexOf(moment(calendar.getDate()).format('YYYYMMDD')) === -1) {
					$('#yevmiyeDuzenle').prop('hidden', true);
				} else {
					$('#yevmiyeDuzenle').prop('hidden', false);
					$('#yevmiyeEkle').prop('hidden', true);
				}
			}, 75)
		});

	</script>
@endsection
