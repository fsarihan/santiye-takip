<?php
	
	namespace App;
	
	use Illuminate\Database\Eloquent\Model;
	
	class Sirketler extends Model
	{
		//use Notifiable;
		
		protected $fillable = [
			'sirket_adi',
			'vergi_numarasi',
			'website',
			'mail',
			'adres',
			'bilgi',
			'telefon',
		];
		
		//public function getGroup() {
		//	return $this->hasOne('App\Model\UserGroup', 'id', 'group_id');
		//}
	}
