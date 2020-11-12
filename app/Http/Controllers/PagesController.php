<?php
	
	namespace App\Http\Controllers;
	
	use App\Odemeler;
	use Carbon\Carbon;
	use Cartalyst\Sentinel\Laravel\Facades\Reminder;
	use Cartalyst\Support\Collection;
	use Illuminate\Support\Facades\Storage;
	use Illuminate\Http\Request;
	use Sentinel;
	use App\Isciler;
	use App\Santiyeler;
	use App\Uzmanliklar;
	use App\CalisanMaaslari;
	use App\IsciSantiyeBaglanti;
	use App\IsciUzmanlikBaglanti;
	use App\Puantaj;
	use App\KullaniciTipleri;
	use App\CalisanMaasDonem;
	use Illuminate\Support\Facades\Crypt;
	use SoftDeletes;
	use Illuminate\Support\Str;
	
	class PagesController extends Controller
	
	{
		public function kullaniciTipleri() {
			$page_title = 'Kullanıcı Tipleri';
			$page_description = 'Kullanıcı tipleri oluşturun, düzenleyin, yetkilendirin.';
			$user = Sentinel::getUser();
			$sirketID = $user->sirket_id;
			$kullaniciTipleri = KullaniciTipleri::where('sirket_id', $sirketID);
			
			return view('pages.kullaniciTipleri', compact('page_title', 'page_description', 'kullaniciTipleri'));
		}
		
		public function createRole() {
			$user = Sentinel::getUser();
			//$sirketID = $user->sirket_id;
			$role = Sentinel::findRoleBySlug("owners");
			
			if(! $role) {
				$role = Sentinel::getRoleRepository()
					->createModel()
					->create([
						'name' => 'Owner',
						'slug' => 'owners',
					]);
				$role->permissions = [
					'admin' => true,
					'calisan.goruntule' => true,
					'calisan.ekle' => true,
					'calisan.duzenle' => true,
					'calisan.sil' => true,
					'calisan.sadeceKendiSantiyesi' => false,
					'kullanici.goruntule' => true,
					'kullanici.ekle' => true,
					'kullanici.duzenle' => true,
					'kullanici.sil' => true,
					'santiye.goruntule' => true,
					'santiye.degistirTumu' => true,
					'santiye.ekle' => true,
					'santiye.duzenle' => true,
					'santiye.puantaj.goruntule' => true,
					'santiye.puantaj.ekle' => true,
					'santiye.puantaj.duzenle' => true,
					'santiye.puantaj.onayla' => true,
				];
				$role->save();
			}
		}
		
		public static function secilebilirSantiyeler($request) {
			$user = Sentinel::getUser();
			$sirketID = $user->sirket_id;
			$sirketeAitSantiyeler = Santiyeler::where('sirket_id', $sirketID)
				->get()
				->toArray();
			$secilebilirSantiyeler = $sirketeAitSantiyeler;
			if($request->session()
				->has('seciliSantiyeAdi')) {
				$seciliSantiye = $request->session()
					->get('seciliSantiyeAdi');
			} else {
				$request->session()
					->put('seciliSantiyeAdi', $sirketeAitSantiyeler[0]['adi']);
				$request->session()
					->put('seciliSantiyeID', $sirketeAitSantiyeler[0]['id']);
				$seciliSantiye = $sirketeAitSantiyeler[0]['adi'];
			}
			
			return [$secilebilirSantiyeler, $seciliSantiye];
		}
		
		public function santiyeSec(Request $request, $santiyeID) {
			$sirketeAitSantiye = Santiyeler::where('id', $santiyeID)
				->first();
			
			$request->session()
				->put('seciliSantiyeAdi', $sirketeAitSantiye['adi']);
			$request->session()
				->put('seciliSantiyeID', $sirketeAitSantiye['id']);
			
			return redirect()
				->back()
				->with('success', 'Seçili şantiyeniz başarıyla değiştirild.');
		}
		
		public function index() {
			$page_title = 'Anasayfa';
			$page_description = 'Şantiye uygulaması.';
			
			return view('pages.dashboard', compact('page_title', 'page_description'));
		}
		
		public function calisanEkle() {
			$user = Sentinel::getUser();
			$sirketID = $user->sirket_id;
			$sirketeAitSantiyeler = Santiyeler::where('sirket_id', $sirketID)
				->get()
				->toArray();
			
			return view('pages.calisanEkle')->with('santiyeler', $sirketeAitSantiyeler);
		}
		
		public function calisanEklePost(Request $request) {
			$user = Sentinel::getUser();
			$sirketID = $user->sirket_id;
			$adi = $request->input('isim');
			$tcNo = $request->input('tcno');
			$adres = $request->input('adres');
			$telefon = $request->input('telefon');
			$meslekKodu = $request->input('meslek_kodu');
			$uzmanliklarInput = json_decode($request->input('tagsX'));
			$maastipi = $request->input('maas_radio');
			$ucret = $request->input('ucret');
			$iban = $request->input('iban');
			$mail = $request->input('mail');
			$states = $request->input('states');
			$kullaniciDurumu = $request->input('kullanici_durumu');
			$uzmanliklarDB = new Uzmanliklar;
			
			$isci = new Isciler;
			$isci->adi = $adi;
			$isci->tc_no = $tcNo;
			$isci->adres = $adres;
			$isci->sirket_id = $sirketID;
			$isci->telefon = $telefon;
			$isci->meslek_kodu = $meslekKodu;
			$isci->iban = $iban;
			$isci->save();
			$olusturulanIsciID = $isci->id;
			if($kullaniciDurumu == "on") {
				//TODO: İlerde mail gönderip şifreyi kendi belirleyeceği şekilde yaparız.
				$credentials = [
					'email' => $mail,
					'password' => $tcNo,
				];
				$newUser = Sentinel::registerAndActivate($credentials);
				$newUser->sirket_id = $sirketID;
				$newUser->isci_id = $olusturulanIsciID;
				$newUser->save();
			}
			foreach($states as $state) {
				if($state != "0" and $state != "AL") {
					$isciSantiye = new IsciSantiyeBaglanti;
					$isciSantiye->isci_id = $olusturulanIsciID;
					$isciSantiye->santiye_id = $state;
					$isciSantiye->save();
				}
			}
			
			$isciMaas = new CalisanMaaslari;
			$isciMaas->ucret_turu_id = $maastipi;
			$isciMaas->ucret = $ucret;
			$isciMaas->isci_id = $olusturulanIsciID;
			$isciMaas->save();
			
			foreach($uzmanliklarInput as $uzmanlikTek) {
				$uzmanlikText = $uzmanlikTek->value;
				$dbKarsilik = $uzmanliklarDB::where('uzmanlik', $uzmanlikText)
					->first();;
				if($dbKarsilik === null) {
					//böyle bir uzmanlık yoksa
					$yeniUzmanlik = new Uzmanliklar;
					$yeniUzmanlik->uzmanlik = $uzmanlikText;
					$yeniUzmanlik->save();
					$dbUzmanlikID = $yeniUzmanlik->id;
				} else {
					$dbUzmanlikID = $dbKarsilik->id;
				}
				$isciUzmanlikBaglanti = new IsciUzmanlikBaglanti;
				$isciUzmanlikBaglanti->isci_id = $olusturulanIsciID;
				$isciUzmanlikBaglanti->uzmanlik_id = $dbUzmanlikID;
				$isciUzmanlikBaglanti->save();
			}
			$status = 0;
			$msg = "Tamamlandı.";
			
			return redirect()
				->route('panel.calisanlar')
				->with('success', 'Kayıt işlemi başarıyla tamamlandı.');
			//TODO: hataları ayıklamak.
			//TODO: aynı zamanda kullanıcı seçeneği var ise 2. bir sayfaya götürüp yetkileri ayarlamak.
			//TODO: kayıt yaptırırken aynı şirket ID de tc kimlik numarası aynı olan kişi kaydı barınamaz yapmak!
			//TODO: işin güncelleme kısmını düşünmek.
			
		}
		
		function calisanlar() {
			$user = Sentinel::getUser();
			$sirketID = $user->sirket_id;
			$sirketeAitSantiyeler = Santiyeler::where('sirket_id', $sirketID)
				->get()
				->toArray();
			$isciler = Isciler::where('sirket_id', $sirketID)
				->get()
				->map(function ($isci) {
					$isciSantiyeleri = $isci->getSantiye()
						->get();
					$isciUzmanliklari = $isci->getUzmanlik()
						->get();
					$santiyeler = [];
					foreach($isciSantiyeleri as $santiye) {
						$santiyeDetay = Santiyeler::find($santiye->santiye_id);
						$santiyeler[] = [$santiyeDetay->adi, $santiyeDetay->id];
					}
					$isciUzmanliklar = [];
					foreach($isciUzmanliklari as $isciUzmanlik) {
						$uzmanlikDetay = Uzmanliklar::find($isciUzmanlik->uzmanlik_id);
						$isciUzmanliklar[] = $uzmanlikDetay->uzmanlik;
					}
					$isci->santiyeler = $santiyeler;
					$isci->uzmanlik = $isciUzmanliklar;
					
					return $isci;
				});
			$data = [
				'calisanlar' => $isciler,
				'santiyeler' => $sirketeAitSantiyeler,
			];
			
			return view('pages.calisanlar')->with('data', $data);
		}
		
		function odemeTalebiOlustur(Request $request, $hashCrypted) {
			$user = Sentinel::getUser();
			$sirketID = $user->sirket_id;
			$seciliSantiye = $request->session()
				->get('seciliSantiyeID');
			$hash = json_decode(Crypt::decrypt($hashCrypted, false));
			$odemeler = new Odemeler;
			$odemeler->tutar = $hash->toplamTutar;
			$odemeler->odenen_tutar = 0;
			$odemeler->odeme_durum_id = 1;
			$odemeler->odeme_turu_id = 1;
			$odemeler->talep_olusturan_id = $user->id;
			$odemeler->sirket_id = $sirketID;
			$odemeler->santiye_id = $seciliSantiye;
			$odemeler->aciklama = $hash->donem." Maaşları";
			$odemeler->kdv_orani = 0;
			$odemeler->odeme_kategori_id = 1;
			$odemeler->odenecegi_tarih = new Carbon('first day of next month');
			$odemeler->fatura_tarihi = new Carbon('first day of next month');
			$odemeler->save();
			CalisanMaasDonem::where("id", $hash->calisanMaasDonemID)
				->where("donem", $hash->donem)
				->update(['odeme_id' => $odemeler->id]);
			
			return redirect()
				->back()
				->with('success', 'Başarıyla '.$hash->donem.' dönemine ait ödeme talebini oluşturdunuz.');
		}
		
		function santiyeGiderleri(Request $request) {
			$seciliSantiye = $request->session()
				->get('seciliSantiyeID');
			$page_title = 'Çalışan Maaşları';
			$page_description = 'Şantiyenizdeki işçilerin maaş tablosu.';
			$odemeler = Odemeler::where("santiye_id", $seciliSantiye)
				->join('odeme_kategoriler', 'odemeler.odeme_kategori_id', '=', 'odeme_kategoriler.id')
				->join('odeme_turler', 'odemeler.odeme_turu_id', '=', 'odeme_turler.id')
				->join('odeme_durumlar', 'odemeler.odeme_durum_id', '=', 'odeme_durumlar.id')
				->orderBy('created_at', 'desc')
				->get()
				->toArray();
			
			return view('pages.giderlerSantiye', compact('page_title', 'page_description', 'odemeler'));
		}
		
		function santiyeGideriEkle(Request $request) {
			$page_title = 'Şantiye Gideri Ekle';
			$page_description = 'Şantiyenizdeki her türlü gideri ekleyebilir sonradan düzenleyebilir ve takip edebilirsiniz.';
			$user = Sentinel::getUser();
			$seciliSantiye = $request->session()
				->get('seciliSantiyeID');
			
			return view('pages.santiyeGiderEkle', compact('page_title', 'page_description'));
		}
		
		public function santiyeGideriEklePost(Request $request) {
			$user = Sentinel::getUser();
			$seciliSantiye = $request->session()
				->get('seciliSantiyeID');
			$sirketID = $user->sirket_id;
			$request->validate([
				'faturaGorsel' => 'mimes:jpeg,png|max:7250',
			]);
			$filePath = null;
			if($request->file()) {
				$filePath = $request->file('faturaGorsel')
					->store('uploads', 'public');
			}
			$odeme = new Odemeler();
			$odeme->santiye_id = $seciliSantiye;
			$odeme->sirket_id = $sirketID;
			$odeme->aciklama = $request->input('aciklama');
			$odeme->tutar = $request->input('toplamTutar');
			$odeme->kdv_orani = $request->input('kdvOran');
			$odeme->fatura_tarihi = $request->input('faturaTarihi');
			$odeme->odeme_kategori_id = 2;
			$odeme->talep_olusturan_id = $user->id;
			$odeme->fatura_gorsel = $filePath;
			if($request->input('m_option_1') == 0) {
				//Ödenecek durumu, ödeneceği tarih gerekli.
				$odeme->odenecegi_tarih = $request->input('odenecegiTarih');
				$odeme->odeme_durum_id = 1;
				$odeme->odeme_turu_id = 1;
				$odeme->odenen_tutar = 0;
			} elseif($request->input('m_option_1') == 1) {
				//Ödendi durumu
				$odeme->odenen_tutar = $request->input('toplamTutar');
				$odeme->odeme_durum_id = 2;
				switch($request->input('odemeYontemi')) {
					case 0:
						//Merkez
						$odeme->odendigi_tarih = $request->input('faturaTarihi');
						$odeme->odeme_turu_id = 1;
						break;
					case 1:
						//Şantiye Kasası
						$odeme->odendigi_tarih = $request->input('faturaTarihi');
						$odeme->odeme_turu_id = 2;
						break;
					case 2:
						//Çalışan tarafından
						$odeme->odendigi_tarih = $request->input('faturaTarihi');
						$odeme->odeme_turu_id = 4;
						$odeme->odenecegi_kisi_id = 1;  //TODO: frontendde isim seçip buraya id olarak düşürt.
						$odeme->odenecegi_kisi_tarih = $request->input('calisanaOdenecegiTarih');
						break;
				}
			}
			
			$odeme->save();
			
			return redirect()
				->route('panel.santiyeGiderleri')
				->with('success', 'Şantiye gideri başarıyla eklendi..');
		}
		
		function calisanMaaslariSantiye(Request $request) {
			//TODO: maaş updatei yaparken onaylanmamış dönem var ise uyar!
			$page_title = 'Çalışan Maaşları';
			$page_description = 'Şantiyenizdeki işçilerin maaş tablosu.';
			$user = Sentinel::getUser();
			$seciliSantiye = $request->session()
				->get('seciliSantiyeID');
			$puantaj = [];
			//TODO: 2020 sabit bir yıl olarak yazıldı, dinamik yapısı için düşün.
			for($z = 0; $z < Carbon::now()->month; $z++) {
				if($z < 10) {
					$i = str_pad($z, 2, "0", STR_PAD_LEFT);
				} else {
					$i = $z;
				}
				$donemMaaslar = $this->maasHesapla($seciliSantiye, '2020/'.$i);
				if($donemMaaslar->count() > 0) {
					$calisanMaasDonem = CalisanMaasDonem::where("santiye_id", $seciliSantiye)
						->where("donem", "2020-".$i)
						->first();
					$calisanMaasDonemOdemeler = CalisanMaasDonem::where("calisan_maas_donem.santiye_id", $seciliSantiye)
						->where("calisan_maas_donem.donem", "2020-".$i)
						->join('odemeler', 'calisan_maas_donem.odeme_id', '=', 'odemeler.id')
						->join('odeme_durumlar', 'odemeler.odeme_durum_id', '=', 'odeme_durumlar.id')
						->first();
					$puantaj['2020/'.$i]['odemeDurumu'] = $calisanMaasDonemOdemeler['durum'];
					$puantaj['2020/'.$i]['odemeDurumuClass'] = $calisanMaasDonemOdemeler['class'];
					if($calisanMaasDonem) {
						$user = Sentinel::findById($calisanMaasDonem['onaylayan_id']);
						$isci = Isciler::where('id', $user->isci_id)
							->first();
						$puantaj['2020/'.$i]['onay'] = true;
						$puantaj['2020/'.$i]['onaylayan'] = $isci['adi'];
					} else {
						$puantaj['2020/'.$i]['onay'] = false;
						$puantaj['2020/'.$i]['onaylayan'] = false;
					}
					$puantaj['2020/'.$i]['donem'] = '2020/'.$i;
					$puantaj['2020/'.$i]['URL'] = '2020-'.$i;
					
					foreach($donemMaaslar as $donemMaas) {
						if(isset($puantaj['2020/'.$i]['genelToplamUcret'])) {
							$puantaj['2020/'.$i]['genelToplamUcret'] += $donemMaas['toplamUcret'];
						} else {
							$puantaj['2020/'.$i]['genelToplamUcret'] = $donemMaas['toplamUcret'];
						}
						if(isset($puantaj['2020/'.$i]['calisanSayisi'])) {
							$puantaj['2020/'.$i]['calisanSayisi'] += 1;
						} else {
							$puantaj['2020/'.$i]['calisanSayisi'] = 1;
						}
					}
					$hash['toplamTutar'] = $puantaj['2020/'.$i]['genelToplamUcret'];
					$hash['donem'] = '2020-'.$i;
					$hash['calisanMaasDonemID'] = $calisanMaasDonem['id'];
					$puantaj['2020/'.$i]['hash'] = Crypt::encryptString(json_encode($hash));
				}
			}
			$puantaj = collect($puantaj)
				->sortBy('donem')
				->reverse()
				->toArray();
			
			return view('pages.maasListeSantiye', compact('page_title', 'page_description', 'puantaj'));
		}
		
		function calisanMaaslariSantiyeDonem(Request $request, $seciliTarih) {
			$page_title = 'Çalışan Maaşları';
			$page_description = 'Şantiyenizdeki işçilerin maaş tablosu.';
			$user = Sentinel::getUser();
			$sirketID = $user->sirket_id;
			$seciliSantiye = $request->session()
				->get('seciliSantiyeID');
			$maaslar = $this->maasHesapla($seciliSantiye, $seciliTarih);
			
			return view('pages.calisanMaaslariSantiye', compact('page_title', 'page_description', 'maaslar'));
		}
		
		private function maasHesapla($seciliSantiye, $seciliTarih) {
			$seciliTarih = Str::replaceFirst("/", "-", $seciliTarih);
			$puantaj = Puantaj::where('santiye_id', $seciliSantiye)
				->whereBetween('tarih', [$seciliTarih.'-01 00:00:00', $seciliTarih.'-31 23:59:59'])
				->selectRaw("SUM(puantaj.puan) as toplamPuan")
				->selectRaw("puantaj.isci_id as isciID")
				->groupBy('puantaj.isci_id')
				->get()
				->map(function ($puan) use ($seciliTarih) {
					$isci = Isciler::where('id', $puan['isciID'])
						->first();
					$puan['isci'] = $isci;
					$yevmiye = CalisanMaaslari::where('isci_id', $puan['isciID'])
						->where('created_at', "<=", ($seciliTarih.'-31 00:00:00'))
						->join('ucret_turleri', 'calisan_maaslari.ucret_turu_id', '=', 'ucret_turleri.id')
						->orderBy('calisan_maaslari.created_at', 'desc')
						->first();
					if(! $yevmiye) {
						$yevmiye = CalisanMaaslari::where('isci_id', $puan['isciID'])
							->join('ucret_turleri', 'calisan_maaslari.ucret_turu_id', '=', 'ucret_turleri.id')
							->orderBy('calisan_maaslari.created_at', 'desc')
							->first();
					}
					$puan['ucretTuru'] = $yevmiye->tur;
					$puan['yevmiye'] = $yevmiye->ucret;
					if($yevmiye->ucret_turu_id == 2) {
						$puan['toplamUcret'] = $yevmiye->ucret * $puan->toplamPuan;
					}
					if($yevmiye->ucret_turu_id == 1) {
						$puan['toplamUcret'] = $yevmiye->ucret;
					}
					
					return $puan;
				})
				->filter(function ($puan) {
					if($puan['toplamUcret'] > 0) {
						return true;
					}
				});
			
			return $puantaj;
		}
		
		function santiyeler() {
			$page_title = 'Şantiyeler';
			$page_description = 'Şirketinize ait şantiyelerin listesi.';
			$user = Sentinel::getUser();
			$sirketID = $user->sirket_id;
			$sirketeAitSantiyeler = Santiyeler::where('sirket_id', $sirketID)
				->get()
				->toArray();
			
			return view('pages.santiyeler', compact('page_title', 'page_description', 'sirketeAitSantiyeler'));
		}
		
		function puantajPost(Request $request) {
			
			//TODO: gelen istekte istek yapan kişi şantiyede yetkili mi? istek yapılan şantiye ıd istek yapan kişinin şirketinde mi şeklinde güvenlik sorgularını çalıştır.
			$yevmiyeler = $request->input("calisanYevmiye");
			$seciliSantiyeID = $request->input("santiyeID");
			$seciliGun = Carbon::parse($request->input("seciliGun"))
				->toDatetimeString();
			
			foreach($yevmiyeler as $yevmiye) {
				Puantaj::where('isci_id', explode("|", $yevmiye)[0])
					->where('tarih', $seciliGun)
					->delete();
				$puantaj = new Puantaj;
				$puantaj->tarih = $seciliGun;
				$puantaj->isci_id = explode("|", $yevmiye)[0];
				$puantaj->puan = explode("|", $yevmiye)[1];
				$puantaj->santiye_id = $seciliSantiyeID;
				$puantaj->save();
			}
			
			return redirect()
				->route('panel.puantaj')
				->with('success', 'Puantaj başarıyla '.$seciliGun.' tarihi için kaydedildi.');
		}
		
		function puantajOnay(Request $request, $donem) {
			$user = Sentinel::getUser();
			$sirketID = $user->sirket_id;
			$seciliSantiye = $request->session()
				->get('seciliSantiyeID');
			$calisanMaasDonem = new CalisanMaasDonem();
			$calisanMaasDonem->donem = $donem;
			$calisanMaasDonem->santiye_id = $seciliSantiye;
			$calisanMaasDonem->onaylayan_id = $user['id'];
			$calisanMaasDonem->save();
			$previousUrl = app('url')->previous();
			
			//return redirect()
			//	->back()
			//	->with('success', 'Seçili dönem ('.$donem.') başarıyla onaylandı.');
			
			return redirect()
				->to($previousUrl.'?'.http_build_query(['donem' => $donem]))
				->with('success', 'Seçili dönem ('.$donem.') başarıyla onaylandı.');
		}
		
		function puantaj(Request $request) {
			$page_title = 'Puantaj';
			$page_description = 'Seçili Şantiyenin Puantaj Listesi.';
			$user = Sentinel::getUser();
			$sirketID = $user->sirket_id;
			$seciliSantiyeID = $request->session()
				->get('seciliSantiyeID');
			$calisanMaasDonem = CalisanMaasDonem::where("santiye_id", $seciliSantiyeID)
				->get();
			$puantaj = Puantaj::where('santiye_id', $seciliSantiyeID)
				->get()
				->map(function ($puan) {
					switch($puan['puan']) {
						case "0":
							$puan['class'] = "";
							break;
						case "1":
							$puan['class'] = "primary";
							break;
						case "0.5":
							$puan['class'] = "warning";
							break;
						case "1.5":
							$puan['class'] = "info";
							break;
						case "2":
							$puan['class'] = "danger";
							break;
					}
					
					return $puan;
				});
			$isciler = Isciler::where('sirket_id', $sirketID)
				->get()
				->map(function ($isci) use ($seciliSantiyeID) {
					$isciSantiyeleri = $isci->getSantiye()
						->get();
					$santiyeCalisaniMi = false;
					foreach($isciSantiyeleri as $santiye) {
						if($seciliSantiyeID == $santiye['santiye_id']) {
							$santiyeCalisaniMi = true;
						}
					}
					$isci['santiyeCalisanMi'] = $santiyeCalisaniMi;
					
					return $isci;
				});
			$isciler = $isciler->filter(function ($value, $key) {
				return $value['santiyeCalisanMi'];
			});
			$calisanMaasDonem = base64_encode(json_encode($calisanMaasDonem));
			
			return view('pages.puantaj', compact('page_title', 'page_description', 'seciliSantiyeID', 'isciler', 'puantaj', 'calisanMaasDonem'));
		}
		
		public function datatables() {
			$page_title = 'Datatables';
			$page_description = 'This is datatables test page';
			
			return view('pages.datatables', compact('page_title', 'page_description'));
		}
		
		// KTDatatables
		public function ktDatatables() {
			$page_title = 'KTDatatables';
			$page_description = 'This is KTdatatables test page';
			
			return view('pages.ktdatatables', compact('page_title', 'page_description'));
		}
		
		// Select2
		public function select2() {
			$page_title = 'Select 2';
			$page_description = 'This is Select2 test page';
			
			return view('pages.select2', compact('page_title', 'page_description'));
		}
		
		// custom-icons
		public function customIcons() {
			$page_title = 'customIcons';
			$page_description = 'This is customIcons test page';
			
			return view('pages.icons.custom-icons', compact('page_title', 'page_description'));
		}
		
		// flaticon
		public function flaticon() {
			$page_title = 'flaticon';
			$page_description = 'This is flaticon test page';
			
			return view('pages.icons.flaticon', compact('page_title', 'page_description'));
		}
		
		// fontawesome
		public function fontawesome() {
			$page_title = 'fontawesome';
			$page_description = 'This is fontawesome test page';
			
			return view('pages.icons.fontawesome', compact('page_title', 'page_description'));
		}
		
		// lineawesome
		public function lineawesome() {
			$page_title = 'lineawesome';
			$page_description = 'This is lineawesome test page';
			
			return view('pages.icons.lineawesome', compact('page_title', 'page_description'));
		}
		
		// socicons
		public function socicons() {
			$page_title = 'socicons';
			$page_description = 'This is socicons test page';
			
			return view('pages.icons.socicons', compact('page_title', 'page_description'));
		}
		
		// svg
		public function svg() {
			$page_title = 'svg';
			$page_description = 'This is svg test page';
			
			return view('pages.icons.svg', compact('page_title', 'page_description'));
		}
		
		// Quicksearch Result
		public function quickSearch() {
			//return view('layout.partials.extras._quick_search_result');
		}
	}
