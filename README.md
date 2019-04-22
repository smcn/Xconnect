## Üniversite Web Servisleri Tekilleştirme ve Yetkilendirme

* Üniversiteler, çeşitli web servisleri(ÖSYM, KPS, YÖKSİS, DETSİS gibi) kullanmakta,
* Fakat web servis hesaplarını çeşitli dış yazılımlarla(EBYS, OBS, HBYS, BAP gibi) istemeden paylaşmakta...

![kampüs](https://github.com/smcn/api_app_test/blob/master/api1.JPG)

### Projede
* Üniversitelerde kullanılan SOAP servisleri RESTful yapıya döndürüldü,
* JWT ile kulanıcı ve rol doğrulaması, 
* Kullanıcı ve Servis yönetimi, istek sayılarını raporlayan admin arayüzü yapıldı 

![kampüs](https://github.com/smcn/api_app_test/blob/master/api2.JPG)

### Teknolojiler
* /api
	* RESTful Servisleri 
	* [PHP](https://php.org) 7.2
	* [Laravel](https://laravel.com) 5.8
	* [tymon/jwt-auth](https://github.com/tymondesigns/jwt-auth)
			
* /app 
	* Admin Arayüzü
	* [AngularJS](https://angularjs.org) 2 
	
* /test
	* [PHP](https://php.org) 7.2
	* [guzzlehttp/guzzle](https://github.com/guzzle/guzzle)
	* [envms/fluentpdo](https://github.com/envms/fluentpdo)

### Kurulum
```
#git clone https://github.com/smcn/Xconnect.git
```

#### /api
```
#cd api_app_test/api
#composer install
#cp .env.example .env
#php artisan key:generate
#php artisan jwt:secret
#nano .env
		…
		DB_CONNECTION=mysql
		DB_HOST=127.0.0.1
		DB_PORT=3306
		DB_DATABASE=homestead
		DB_USERNAME=homestead
		DB_PASSWORD=secret
		…
#php artisan migrate --seed		
```

#### /app
```
#cd ../app
#nano app.js
		…
		$rootScope.serviceBaseURL = "https://site-adi/api/";
		…
```

### Servisler İçin Yardım Sayfaları
https://site-adi/api

### Admin Arayüzü
https://site-adi/app

#### /test
```
#cd ../test
#composer install
#nano OSYMozGecmis.php
		…
		private $email = 'yoksis@omu.edu.tr';
		private $password = 'secret';
		private $serviceBaseURL = 'https://site-adi/api/';
		…
		$bind = array('');	//TcKimlikNO lar
		…
		$db_host = '127.0.0.1';
		$db_database = ‘osymozgecmis';
		$db_username = ‘osymozgecmis';
		$db_password = 'secret';
		…
#php OSYMozGecmis.php
```
