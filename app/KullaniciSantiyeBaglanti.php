<?php
	
	namespace App;
	
	use Illuminate\Database\Eloquent\Model;
	
	class KullaniciSantiyeBaglanti extends Model
	{
		//use Notifiable;
		
		protected $table = 'kullanici_santiye_baglanti';
		
		protected $fillable = [
			'kullanici_id',
			'santiye_id',
		
		];
	}
