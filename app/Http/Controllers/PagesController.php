<?php
	
	namespace App\Http\Controllers;
	
	use Carbon;
	use Illuminate\Http\Request;
	use Sentinel;
	use App\Isciler;
	use App\Santiyeler;
	use App\Uzmanliklar;
	use App\CalisanMaaslari;
	use App\IsciSantiyeBaglanti;
	use App\IsciUzmanlikBaglanti;
	
	class PagesController extends Controller
	
	{
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
			//dd($request);
			//exit();
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
				->with('success', 'Kaydınız başarıyla tamamlandı.');
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
			//print_r($sirketeAitSantiyeler);
			//exit();
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
		/**
		 * Demo methods below
		 */
		
		// Datatables
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
			return view('layout.partials.extras._quick_search_result');
		}
	}
