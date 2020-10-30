<?php
	
	namespace App;
	
	use Illuminate\Database\Eloquent\Model;
	
	class Uzmanliklar extends Model
	{
		//use Notifiable;
		protected $table = 'isci_uzmanliklar';
		
		protected $fillable = [
			'id',
			'uzmanlik',
		
		];
	}
