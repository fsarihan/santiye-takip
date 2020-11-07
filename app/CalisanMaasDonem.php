<?php
	
	namespace App;
	
	use Illuminate\Database\Eloquent\Model;
	
	class CalisanMaasDonem extends Model
	{
		//use Notifiable;
		protected $table = 'calisan_maas_donem';
		
		protected $fillable = [
			'santiye_id',
			'donem',
			'onaylayan_id',
		
		];
	}
