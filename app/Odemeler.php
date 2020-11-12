<?php
	
	namespace App;
	
	use Illuminate\Database\Eloquent\Model;
	
	class Odemeler extends Model
	{
		//use Notifiable;
		protected $table = 'odemeler';
		
		protected $fillable = [
			'aciklama',
			'odeme_kategori_id',
			'odenecegi_tarih',
			'odendigi_tarih',
			'tutar',
			'odenen_tutar',
			'odeme_durum_id',
			'odeme_turu_id',
			'sirket_id',
			'santiye_id',
			'not',
			'talep_olusturan_id',
			'odenecegi_kisi_id',
			'odenecegi_kisi_tarih',
			'kdv_orani',
			'fatura_gorsel',
			'fatura_tarihi',
		
		];
	}
