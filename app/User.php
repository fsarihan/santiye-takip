<?php
	
	namespace App;
	
	use Illuminate\Notifications\Notifiable;
	
	class User extends \Cartalyst\Sentinel\Users\EloquentUser
	{
		//use Notifiable;
		
		protected $fillable = [
			'email',
			'password',
			'permissions',
			'adi',
			'last_login',
			'sirket_id',
			'telefon',
			'soyadi',
		
		];
		
		//public function getOrganization() {
		//	return $this->hasOne('App\Model\Organization', 'id', 'organization_id');
		//}
	}