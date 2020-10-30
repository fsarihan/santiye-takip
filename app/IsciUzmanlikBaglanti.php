<?php
	
	namespace App;
	
	use Illuminate\Database\Eloquent\Model;
	
	class IsciUzmanlikBaglanti extends Model
	{
		//use Notifiable;
		
		protected $table = 'isci_uzmanlik_baglanti';
		
		protected $fillable = [
			'isci_id',
			'uzmanlik_id',
		
		];
	}
