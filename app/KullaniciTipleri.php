<?php
	
	namespace App;
	
	use Illuminate\Database\Eloquent\Model;
	
	class KullaniciTipleri extends Model
	{
		//use Notifiable;
		protected $table = 'kullanici_tipleri';
		
		protected $fillable = [
			'adi',
			'sirket_id',
			'olusturan_id',
			'role_slug',
		
		];
	}
