<?php
	
	namespace App;
	
	use Illuminate\Database\Eloquent\Model;
	
	class IsciSantiyeBaglanti extends Model
	{
		//use Notifiable;
		
		protected $table = 'isci_santiye_baglanti';
		
		protected $fillable = [
			'isci_id',
			'santiye_id',
		
		];
	}
