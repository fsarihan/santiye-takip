<?php
	
	namespace App;
	
	use Illuminate\Database\Eloquent\Model;
	
	class Santiyeler extends Model
	{
		//use Notifiable;
		protected $table = 'santiyeler';
		
		protected $fillable = [
			'adi',
			'adres',
			'lokasyon',
			'bilgi',
			'durum_id',
			'sirket_id',
			'telefon',
			'baslangic_tarihi',
			'bitis_tarihi',
		];
	}
