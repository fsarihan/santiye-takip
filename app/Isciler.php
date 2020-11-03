<?php
	
	namespace App;
	
	use Illuminate\Database\Eloquent\Model;
	use Illuminate\Database\Eloquent\SoftDeletes;
	
	class Isciler extends Model
	{
		use SoftDeletes;
		
		//use Notifiable;
		protected $table = 'isciler';
		
		protected $fillable = [
			'adi',
			'fotograf',
			'uzmanlik_id',
			'iban',
			'adres',
			'sirket_id',
			'tc_no',
			'isci_durum_id',
			'telefon',
			'sirket_id',
			'meslek_kodu',
		];
		
		public function getSantiye() {
			return $this->hasMany('App\IsciSantiyeBaglanti', 'isci_id', 'id');
		}
		
		public function getUzmanlik() {
			return $this->hasMany('App\IsciUzmanlikBaglanti', 'isci_id', 'id');
		}
	}
