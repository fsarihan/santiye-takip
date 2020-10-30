<?php
	
	namespace App;
	
	use Illuminate\Database\Eloquent\Model;
	
	class CalisanMaaslari extends Model
	{
		//use Notifiable;
		protected $table = 'calisan_maaslari';
		
		protected $fillable = [
			'isci_id',
			'ucret_turu_id',
			'ucret',
		
		];
	}
