{{-- Extends layout --}}
@extends('layout.default')

{{-- Content --}}
@section('content')
	<meta name="csrf-token" content="{{ csrf_token() }}"/>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="https://yaireo.github.io/tagify/dist/jQuery.tagify.min.js"></script>
	<div class="card card-custom gutter-b">
		<div class="card-header">
			<div class="card-title">
				<h3 class="card-label">
					Hızlı Gider Ekle
					<small>Hızlı gider ekleyi kullanarak birim birim madde girmeden tek seferde gider ekleyebilirsiniz.</small>
				</h3>
			</div>
		</div>
		<div class="card-body">
			<form class="form" method="post" enctype="multipart/form-data"
			      action="{{action('PagesController@santiyeGideriEklePost') }}">
				@csrf
				<div class="card-body">
					<div class="form-group">
						<label>Açıklama:</label>
						<input type="text" name="aciklama" class="form-control"
						       placeholder="Gider açıklaması"/>
						<span class="form-text text-muted">Gider açıklaması giriniz.</span>
					</div>
					<div class="separator separator-dashed my-5"></div>
					<div class="form-group">
						<label>Tedarikçi veya taşeron:</label>
						{{--TODO: taşeron modülü yapıldığında autofill özelliği--}}
						<input type="text" name="taseron" class="form-control"
						       placeholder="Taşeron ismi"/>
						<span class="form-text text-muted">Kayıtlı taşeronlarınızdan seçebilir veya yalnızca ismini girebilirsiniz.</span>
					</div>
					<div class="separator separator-dashed my-5"></div>
					<div class="form-group">
						<label>Fatura/Fiş Tarihi:</label>
						<input class="form-control" type="date" name="faturaTarihi" id="faturaTarihi">

					</div>
					<div class="form-group">
						<label>Toplam Tutar:</label>
						<input type="number" name="toplamTutar" id="toplamTutar" min="1" max="10000000" step="any"
						       class="form-control"/>
						<span class="form-text text-muted">Lütfen vergiler dahil toplam tutarı yazınız!</span>
					</div>
					<div class="row">
						<div class="col-lg-10">
							<label>Toplam KDV:</label>
							<input type="text" id="kdvToplam" name="kdvToplam" class="form-control"
							       disabled="disabled"/>
							<span class="form-text text-muted">Ödediğiniz KDV tutarı.</span>
						</div>
						<div class="col-lg-2">
							<label>KDV Oranı:</label>
							<select class="form-control" id="kdvOran" name="kdvOran">
								<option value="0">%0</option>
								<option value="1">%1</option>
								<option value="8">%8</option>
								<option value="18" selected>%18</option>
							</select>
							<span class="form-text text-muted">Ödemenizin KDV oranını seçiniz.</span>
						</div>
					</div>
					<div class="separator separator-dashed my-5"></div>
					<div class="form-group row">
						<label class="col-lg-3 col-form-label text-lg-left">Fiş/Fatura Görseli:</label>
						<div class="col-lg-9">
							<div class="form-group">
								<input type="file" name="faturaGorsel" class="custom-file-input" id="faturaGorsel">
								<label class="custom-file-label" for="faturaGorsel">Görsel seçiniz.</label>
							</div>

						</div>
					</div>
					<div class="separator separator-dashed my-5"></div>
					<label>Ödeme Durumu</label>
					<div class="row">
						<div class="col-lg-6">
							<label class="option">
							<span class="option-control">
								<span class="radio">
									<input type="radio" name="m_option_1" value="0">
										<span></span>
									</span>
								</span>
								<span class="option-label">
									<span class="option-head">
										<span class="option-title">Ödenecek</span>
										<span class="option-focus"><i class="flaticon2-hourglass-1"></i></span>
									</span>
									<span class="option-body">İleri zamanlı ödeme talepleri oluşturun.</span>
								</span>
							</label>
						</div>
						<div class="col-lg-6">
							<label class="option">
								<span class="option-control">
									<span class="radio">
										<input type="radio" name="m_option_1" value="1">
											<span></span>
										</span>
									</span>
								<span class="option-label">
										<span class="option-head">
											<span class="option-title">Ödendi</span>
											<span class="option-focus"><i class="flaticon2-checkmark"></i></span>
										</span>
										<span class="option-body">Ödenen giderin detaylarını kaydedin.</span>
									</span>
							</label>
						</div>
					</div>
					<div class="form-group odenecek" hidden="hidden">
						<div class="form-group">
							<label>Ödeneceği tarih:</label>
							<input class="form-control" type="date" name="odenecegiTarih" id="odenecegiTarih">
							<span class="form-text text-muted">Giderin ödeneceği tarihi seçiniz, şirket merkezine ödeme talebi olarak gönderilecektir.</span>

						</div>

					</div>
					<div class="form-group odendi" hidden="hidden">
						<div class="form-group">
							<label>Ödeme yöntemi:</label>
							<select class="form-control" id="odemeYontemi" name="odemeYontemi">
								<option value="0">Merkez</option>
								<option value="1">Şantiye Kasası</option>
								<option value="2">Çalışan</option>
							</select>
						</div>
						<div class="form-group calisanOdeme" hidden="hidden">
							<div class="form-group">
								<label>Ödeyen Çalışan:</label>
								<input type="text" name="odeyenCalisan" class="form-control"
								       placeholder="Ödeyen Çalışanın İsmi"/>
								<span class="form-text text-muted">Harcamayı yapan çalışanınızın ismini giriniz.</span>
							</div>
							<div class="form-group">
								<label>Geri ödeneceği tarih:</label>
								<input class="form-control" type="date" name="calisanaOdenecegiTarih"
								       id="calisanaOdenecegiTarih">
								<span class="form-text text-muted">Çalışanınıza geri ödeneceği tarihi giriniz, şirket merkezine ödeme talebi olarak gönderilecektir.</span>
							</div>
						</div>

					</div>
				</div>
				<div class="card-footer">
					<button type="submit" class="btn btn-primary mr-2">Ekle</button>
				</div>
			</form>
		</div>
	</div>


	<script>
		var inputX = document.querySelector('input[name=tagsX]');
		tagify = new Tagify(inputX, {
			whitelist: [],
			maxTags: 10,
			dropdown: {
				maxItems: 3,           // <- mixumum allowed rendered suggestions
				classname: "tags-look", // <- custom classname for this dropdown, so it could be targeted
				enabled: false,             // <- show suggestions on focus
				closeOnSelect: true    // <- do not hide the suggestions dropdown once an item has been selected
			}
		});
		$(document).ready(function () {
			$('input[type=radio][name=m_option_1]').change(function () {
				var seciliDeger = this.value; //0: ödenecek, 1: ödendi için gelen valueler.
				if (seciliDeger == 0) {
					$('.odenecek').prop('hidden', false);
					$('.odendi').prop('hidden', true);
				}
				if (seciliDeger == 1) {
					$('.odenecek').prop('hidden', true);
					$('.odendi').prop('hidden', false);
				}
			});


			$("#toplamTutar").on("change paste keyup", function () {
				$("#kdvToplam").val($("#toplamTutar").val() * $("#kdvOran").val() / 100);
			});
			$("#kdvOran").on("change paste keyup", function () {
				$("#kdvToplam").val($("#toplamTutar").val() * $("#kdvOran").val() / 100);
			});
			$("#odemeYontemi").on("change paste keyup", function () {
				if ($("#odemeYontemi").val() == 2) {
					$('.calisanOdeme').prop('hidden', false);
				} else {
					$('.calisanOdeme').prop('hidden', true);
				}
			});


			$('.js-example-basic-multiple').select2();

		});
	</script>

@endsection

{{-- Scripts Section --}}
@section('scripts')
	{{--<script src="{{ asset('js/pages/widgets.js') }}" type="text/javascript"></script>--}}
	<script src="{{ asset('js/app.js') }}" type="text/javascript"></script>
@endsection
