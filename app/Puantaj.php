<?php
	
	namespace App;
	
	use Illuminate\Database\Eloquent\Model;
	
	class Puantaj extends Model
	{
		//use Notifiable;
		protected $table = 'puantaj';
		
		protected $fillable = [
			'tarih',
			'isci_id',
			'santiye_id',
			'puan',
		
		];
	}
