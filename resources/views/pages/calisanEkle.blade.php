{{-- Extends layout --}}
@extends('layout.default')

{{-- Content --}}
@section('content')
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="https://yaireo.github.io/tagify/dist/jQuery.tagify.min.js"></script>
	<div class="card card-custom gutter-b">
		<div class="card-header">
			<div class="card-title">
				<h3 class="card-label">
					Çalışan Ekle
					<small>Şirketinize çalışan ekleyin</small>
				</h3>
			</div>
		</div>
		<div class="card-body">
			<form class="form" method="post" action="{{action('PagesController@calisanEklePost') }}">
				@csrf
				<div class="card-body">
					<div class="form-group">
						<label>Adı Soyadı:</label>
						<input type="text" name="isim" class="form-control form-control-solid"
						       placeholder="Adı Soyadı"/>
						<span class="form-text text-muted">Çalışanınızın adı soyadını tam olarak giriniz.</span>
					</div>
					<div class="form-group">
						<label>TC Kimlik Numarası:</label>
						<input type="text" name="tcno" class="form-control form-control-solid"
						       placeholder="TC Kimlik No"/>
						<span class="form-text text-muted">Çalışanınızın TC kimlik numarasını tam olarak giriniz.</span>
					</div>
					<div class="form-group">
						<label>Adresi:</label>
						<input type="text" name="adres" class="form-control form-control-solid" placeholder="Adres"/>
						<span class="form-text text-muted">Çalışanınızın Adresini giriniz.</span>
					</div>
					<div class="form-group">
						<label>Telefon Numarası:</label>
						<div class="input-group">
							<span class="input-group-text"><i class="la la-phone"></i></span>
							<input type="text" class="form-control form-control-solid" name="telefon"
							       value="" placeholder="Telefon numarası">
						</div>
						<span class="form-text text-muted">Çalışanınızın telefon numarasını giriniz.</span>
					</div>
					<div class="form-group">
						<label>Meslek Kodu:</label>
						<input type="text" name="meslek_kodu" class="form-control form-control-solid"
						       placeholder="0000.00"/>
						<span class="form-text text-muted">Çalışanınızın ünvanına ait SGK meslek kodunu seçiniz. Meslek kodları listesi için <a
									href="http://www.mergumder.org.tr/_yuklenenDosyalar/_dernekDuyurulari/SGK_Meslek_Kodlari.pdf"
									target="_blank">tıklayınız</a>.</span>
					</div>
					<div class="form-group">
						<label>Uzmanlık Alanları:</label>
						<input name='tagsX' class="form-control form-control-solid" value=''>
						<span class="form-text text-muted">Çalışanınızın uzmanlık alanlarını giriniz. Birden fazla girebilirsiniz, ayırmak için virgül kullanabilirsiniz.</span>
					</div>
					<div class="form-group">
						<label>Çalışacağı Yer(ler):</label>
						<select class="form-control form-control-solid js-example-basic-multiple" name="states[]"
						        multiple="multiple">
							<option value="0">Merkez</option>
							@foreach($santiyeler as $santiye)
								<option value="{{$santiye['id']}}">{{$santiye['adi']}}</option>
							@endforeach

						</select>
						<span class="form-text text-muted">Çalışanınızın nerede veya nerelerde çalışacağını seçiniz.</span>
					</div>


					<div class="card card-custom gutter-b">
						<div class="card-header">
							<div class="card-title">
								<h3 class="card-label">Maaş Bilgileri
									<small>Çalışanınızın maaş verisini ekleyin, günlük veya aylık olarak seçebilirsiniz.</small>
								</h3>
							</div>
						</div>
						<div class="card-body">

							<div class="form-group m-0">
								<label>Maaş Tipi:</label>
								<div class="row">
									<div class="col-lg-6">
										<label class="option">
      <span class="option-control">
       <span class="radio">
        <input type="radio" name="maas_radio" value="1" checked="checked"/>
        <span></span>
       </span>
      </span>
											<span class="option-label">
       <span class="option-head">
        <span class="option-title">
         Aylık Maaş
        </span>
        <span class="option-focus">
         <small>Ücretler aylık olarak hesaplanır.</small>
        </span>
       </span>
       <span class="option-body">

       </span>
      </span>
										</label>
									</div>
									<div class="col-lg-6">
										<label class="option">
      <span class="option-control">
       <span class="radio">
        <input type="radio" name="maas_radio" value="2"/>
        <span></span>
       </span>
      </span>
											<span class="option-label">
       <span class="option-head">
        <span class="option-title">
         Günlük Maaş
        </span>
        <span class="option-focus">
          <small>Ücretler günlük olarak hesaplanır.</small>
        </span>
       </span>
       <span class="option-body">

       </span>
      </span>
										</label>
									</div>
								</div>
							</div>
							<div class="form-group">
								<label>Ücret:</label>
								<div class="input-group">
									<span class="input-group-text">TL</span>
									<input type="text" name="ucret" class="form-control form-control-solid"
									       placeholder="ÜCRET"/>
								</div>
								<span class="form-text text-muted">Çalışanınızın alacağı net ücret.</span>
							</div>
							<div class="form-group">
								<label>IBAN Numarası:</label>
								<input type="text" name="iban" class="form-control form-control-solid"
								       placeholder="IBAN No"/>
								<span class="form-text text-muted">Çalışanınızın IBAN numarasını tam olarak giriniz.</span>
							</div>
						</div>
					</div>
					<div class="container">
						<div class="row">
							<label class="col-6 col-form-label">Kullanıcı olarak kaydedilsin mi?</br>
								<small>Çalışanınız aynı zamanda şantiye sistemine girebilecek bir kullanıcı olarak kaydedilsin mi?</small>
							</label>

							<div class="col-6">
															<span class="switch switch-icon">
																<label>
																	<input type="checkbox"
																	       name="kullanici_durumu">
																	<span></span>
																</label>
															</span>
							</div>
							<div class="col-6">
								<div class="form-group">
									<label>Mail Adresi*:</label>
									<input name='mail' type="email" class="form-control form-control-solid" value=''>
									<span class="form-text text-muted">*Kullanıcı olarak kaydedilecek çalışanların mail adresi girmesi zorunludur.</span>
								</div>
							</div>


						</div>
					</div>
				</div>
				<div class="card-footer">
					<button type="submit" class="btn btn-primary mr-2">Ekle</button>
					<button type="reset" class="btn btn-secondary">İptal</button>
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
			$('.js-example-basic-multiple').select2();
		});
	</script>

@endsection

{{-- Scripts Section --}}
@section('scripts')
	<script src="{{ asset('js/pages/widgets.js') }}" type="text/javascript"></script>
@endsection
