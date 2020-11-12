<?php
	// Aside menu
	return [
		
		'items' => [
			// Dashboard
			[
				'title' => 'Anasayfa',
				'root' => true,
				'icon' => 'media/svg/icons/Design/Layers.svg', // or can be 'flaticon-home' or any flaticon-*
				'page' => '/',
				'new-tab' => false,
			],
			[
				'title' => 'E-Mail',
				'root' => true,
				'icon' => 'flaticon2-mail', // or can be 'flaticon-home' or any flaticon-*
				'page' => '/',
				'new-tab' => true,
			],
			
			// Layout
			[
				'section' => 'Şantiye Yönetimi',
			],
			
			[
				'title' => 'Şantiye Puantaj',
				'root' => true,
				'icon' => 'flaticon-event-calendar-symbol',
				'page' => 'panel/puantaj',
				'visible' => 'preview',
			
			],
			[
				'title' => 'Şantiye Muhasebe',
				'root' => true,
				'icon' => 'flaticon-pie-chart-1',
				'page' => 'panel/santiye-muhasebe',
				'visible' => 'preview',
				'submenu' => [
					[
						'title' => 'Genel Görünüm',
						'page' => 'panel/santiye-muhasebe',
					],
					[
						'title' => 'Çalışan Maaşları',
						'page' => 'panel/santiye-muhasebe/calisan-maaslari',
					],
					[
						'title' => 'Şantiye Giderleri',
						'page' => 'panel/santiye-muhasebe/santiye-giderleri',
					],
				],
			],
			[
				'title' => 'Şantiye Panosu',
				'root' => true,
				'icon' => 'flaticon2-layers-1',
				'page' => 'builder',
				'visible' => 'preview',
			],
			[
				'title' => 'Şantiye Dosyalar',
				'root' => true,
				'icon' => 'flaticon2-folder',
				'page' => 'builder',
				'visible' => 'preview',
			],
			[
				'title' => 'Şantiye Hakedişler',
				'root' => true,
				'icon' => 'flaticon2-checking',
				'page' => 'builder',
				'visible' => 'preview',
			],
			// Layout
			[
				'section' => 'Şirket Yönetimi',
			],
			[
				'title' => 'Çalışanlar',
				'root' => true,
				'icon' => 'flaticon2-user',
				'page' => 'panel/calisanlar',
				'visible' => 'preview',
			],
			[
				'title' => 'Kullanıcılar',
				'root' => true,
				'icon' => 'flaticon-users-1',
				'page' => 'builder',
				'visible' => 'preview',
			],
			[
				'title' => 'Kullanıcı Tipleri',
				'root' => true,
				'icon' => 'flaticon2-group',
				'page' => 'panel/kullanici-tipleri',
				'visible' => 'preview',
			],
			[
				'title' => 'Şantiyeler',
				'root' => true,
				'icon' => 'media/svg/icons/Home/Library.svg',
				'page' => 'panel/santiyeler',
				'visible' => 'preview',
			],
			[
				'title' => 'Şirket Muhasebe',
				'root' => true,
				'icon' => 'flaticon-pie-chart-1',
				'page' => 'builder',
				'visible' => 'preview',
			],
			[
				'title' => 'Şirket Dosyalar',
				'root' => true,
				'icon' => 'flaticon2-folder',
				'page' => 'builder',
				'visible' => 'preview',
			],
			[
				'title' => 'Şirket Yönetimi',
				'root' => true,
				'icon' => 'flaticon2-settings',
				'page' => 'builder',
				'visible' => 'preview',
			],
		],
	];
