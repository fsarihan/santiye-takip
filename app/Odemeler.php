<?php
	
	namespace App;
	
	use Illuminate\Database\Eloquent\Model;
	
	class Odemeler extends Model
	{
		//use Notifiable;
		protected $table = 'odemeler';
		
		protected $fillable = [
			'tutar',
			'odenen_tutar',
			'odeme_durum_id',
			'odeme_turu_id',
			'not',
		
		];
	}
