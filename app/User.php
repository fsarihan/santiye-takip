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
			'name',
			'last_login',
			'isci_id',
			'sirket_id',
		];
		
		//public function getGroup() {
		//	return $this->hasOne('App\Model\UserGroup', 'id', 'group_id');
		//}
		//
		//public function getCountry() {
		//	return $this->hasOne('App\Model\Country', 'id', 'country_id');
		//}
		//
		//public function getZone() {
		//	return $this->hasOne('App\Model\Zone', 'id', 'time_zone_id');
		//}
		//
		//public function getOrganization() {
		//	return $this->hasOne('App\Model\Organization', 'id', 'organization_id');
		//}
	}
