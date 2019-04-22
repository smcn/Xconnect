<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Service;
use JWTAuth;

class YoksisController extends Controller
{
	
	public function UniversiteBirimlerv4(Request $request){
		
		$client = new \SoapClient("https://servisler.yok.gov.tr/ws/UniversiteBirimlerv4?WSDL");

		try {
			$method = $request->route('method');
			$params = array('BIRIM_ID' => $request->route('id'), 
							'GUN' => $request->route('gun'), 
							'AY'=> $request->route('ay'), 
							'YIL' => $request->route('yil')
							);
			$result = $client->__soapCall($method, array($params));
			
			return response()->json($result);
		}catch (Exception $e){
			return response()->json(array('success'=>false, 'error'=>"$e->getMessage()"));
		}
		
	}
	//UniversiteleriGetirv4
	//IDdenBirimAdiGetirv4/{id}
	//TarihtenBirimDegisiklikGetirv4/{gun}/{ay}/{yil}
	//AltBirimleriGetirv4/{id}
	//AltBirimdekiProgramlariGetirv4/{id}
	
	public function Ozgecmisv1(Request $request){
		
		$client = new \SoapClient("https://servisler.yok.gov.tr/ws/ozgecmisv1?wsdl");
		$service = Service::where('name', $request->route()->getAction('role'))->get();

		$username = $service[0]['account'];
		$password = $service[0]['password']; 
		try {
			$method = $request->route('method');
			$params = array('P_KULLANICI_ID'=> $username, 
							'P_SIFRE' => $password, 
							'P_TC_KIMLIK_NO'=> $request->route('id'), 
							'P_TARIH'=> $request->route('date'), 
							'P_DONEM'=> $request->route('date')
							);
			
			$result = $client->__soapCall($method, array(array("parametre" => $params)) );
			
			return response()->json($result);
		}catch (Exception $e){
			return response()->json(array('success'=>false, 'error'=>"$e->getMessage()"));
		}
		
	}
	/*
	getirAkademikGorevListesi
	getArastirmaSertifkaBilgisiV1
	getirUnvDisiDeneyimListesi
	getirDersListesi
	getEditorlukBilgisiV1
	getirIdariGorevListesi
	getKitapBilgisiV1
	getMakaleBilgisiV1
	getOdulListesiV1
	getirOgrenimBilgisiListesi
	getPatentBilgisiV1
	getirProjeListesi
	getTasarimBilgisiV1
	getTemelAlanBilgisiV1
	getirTezDanismanListesi
	getirUyelikListesi
	getirYabanciDilListesi
	getYazarListesiV1
	getPersonelLinkV1
	getSanatsalFaalV1
	getHakemlikBilgisiV1
	getBildiriBilgisiV1
	getirBeyanTesvik
	getirBasvuruDurum
	getirAtifSayilari
	getTesvikKatsayi
	*/

	public function UniversiteAkademikPersonelv1(Request $request){
		
		$service = Service::where('name', $request->route()->getAction('role'))->get();
		
		$account = array(
			 'login' => $service[0]['account'],
			 'password' => $service[0]['password']
		);
		
		$user = JWTAuth::parseToken()->authenticate();
		
		$client = new \SoapClient("https://servisler.yok.gov.tr/ws/UniversiteAkademikPersonelv1?WSDL", $account);		
		try {
			$method = $request->route('method');
			$params = array('SORGULAYAN_TC_KIMLIK_NO'=> $user['tckimlikno'], 
							'AKPER_TC_KIMLIK_NO' => $request->route('id'),
							'SAYFA' => $request->route('id')
							);
			
			$result = $client->__soapCall($method, array($params));
			
			return response()->json($result);
		}catch (Exception $e){
			return response()->json(array('success'=>false, 'error'=>"$e->getMessage()"));
		}
		
	}
	//kullaniciyaGoreTcKimlikNodan_Akademik_Personel_Bilgisiv1/{id}AKPER_TC_KIMLIK_NO
	//kullaniciyaGoreUniversitedeki_Akademik_Personel_Bilgisiv1/{id}SAYFA
	//kullaniciyaGoreUniversiteki_Akademik_Personel_SayfaSayisiv1
	//getMernisUyruk
	
	public function TcKimlikNoileMezunOgrenciSorgulav2(Request $request){
		
		
		$service = Service::where('name', $request->route()->getAction('role'))->get();
		
		$account = array(
			 'login' => $service[0]['account2'],
			 'password' => $service[0]['password2']
		);
		
		$client = new \SoapClient("https://servisler.yok.gov.tr/ws/TcKimlikNoileMezunOgrenciSorgulav2?WSDL", $account);		
		try {
			$method = $request->route('method');
			$params = array('TCKNO'=> $request->route('id')
							);
			
			$result = $client->__soapCall($method, array($params));
			
			return response()->json($result);
		}catch (Exception $e){
			return response()->json(array('success'=>false, 'error'=>"$e->getMessage()"));
		}
		
	}
	//TcKimlikNoilMezunOgrenciSorgulav2
	
	public function TcKimlikNoileOgrenciSorgulaDetayv4(Request $request){
		
		$service = Service::where('name', $request->route()->getAction('role'))->get();
		
		$account = array(
			 'login' => $service[0]['account2'],
			 'password' => $service[0]['password2']
		);
		
		$client = new \SoapClient("https://servisler.yok.gov.tr/ws/TcKimlikNoileOgrenciSorgulaDetayv4?WSDL", $account);		
		try {
			$method = $request->route('method');
			$params = array('TC_KIMLIK_NO'=> $request->route('id')
							);
			
			$result = $client->__soapCall($method, array($params));
			
			return response()->json($result);
		}catch (Exception $e){
			return response()->json(array('success'=>false, 'error'=>"$e->getMessage()"));
		}
		
	}
	//TcKimlikNoileOgrenciSorgulaDetayv4
	
	///////şu an çalışmıyor
	public function MEBMezunSorgulav2(Request $request){
		
		$service = Service::where('name', $request->route()->getAction('role'))->get();
		
		$account = array(
			 'login' => $service[0]['account2'],
			 'password' => $service[0]['password2']
		);
		
		$client = new \SoapClient("https://servisler.yok.gov.tr/ws/mebmezunsorgulav2?WSDL", $account);		
		try {
			$method = $request->route('method');
			$params = array('TC_KIMLIK_NO'=> $request->route('id'),
							'ServicePassWord'=> $service[0]['password2']
							);
			
			$result = $client->__soapCall($method, array($params));
			
			return response()->json($result);
		}catch (Exception $e){
			return response()->json(array('success'=>false, 'error'=>"$e->getMessage()"));
		}
		
	}
	//mezuniyetVerileriniGetir
	
	public function Referanslarv1(Request $request){
		
		$service = Service::where('name', $request->route()->getAction('role'))->get();
		
		$client = new \SoapClient("https://servisler.yok.gov.tr/ws/Referanslarv1?WSDL");		
		try {
			$method = $request->route('method');
			
			$result = $client->__soapCall($method, array());
			
			return response()->json($result);
		}catch (Exception $e){
			return response()->json(array('success'=>false, 'error'=>"$e->getMessage()"));
		}
		
	}
	/*
	getGirisTuru
	getIdariBirimler
	getMernisCinsiyet
	getMernisUlke
	getMernisUyruk
	getOgrenciAyrilmaNedeni
	getOgrenciEngelTuru
	getOgrencilikStatusu
	getOgrenciSinif
	getOgrenciDOYKM
	getOgrenciGirisPuanTuru
	getOgrenciOgrencilikHakki
	getOgrenciGirisTuru
	getPersonelGorev
	getOgrenciGaziSehitYakini
	getOgrenciDiplomaNotSistemi
	getKodBid
	getBirimTuru
	getCezaTuru
	getIlceGetir
	getIlGetir
	getOgrenimDili
	getOgrenimTuru
	getUniversiteTuru
	getAktiflikDurumu
	getKadroGorevUnvan
	getPersonelAyrilma
	getYoksisUlke
	getOzgecmisYabanciDil
	getEndeksListesi
	getPersonelAtanma
	getFormasyonAlanlar
	*/
	
	public function TcKimlikNoileTezSorgula(Request $request){
		
		$service = Service::where('name', $request->route()->getAction('role'))->get();
		
		$account = array(
			 'login' => $service[0]['account2'],
			 'password' => $service[0]['password2']
		);
		
		$user = JWTAuth::parseToken()->authenticate();
		
		$client = new \SoapClient("http://servisler.yok.gov.tr/ws/TcKimlikNoileTezSorgula?wsdl", $account);		
		try {
			$method = $request->route('method');
			$params = array(
								'KisiTezSorgulamaRequest' => array(
									'Istek' => array(
										'ActionDate' => $request->route('date'),
										'TransactionId' => $request->route('tid'),
										'KullaniciAdi' => $user['tckimlikno']
									),
									'KisiTezSorgulama' => array(
										'tcKimlikNo'=> (int)$request->route('id')
									)
								)
							);
			
			
			$result = $client->__soapCall($method, $params);
			
			return response()->json($result);
		}catch (Exception $e){
			return response()->json(array('success'=>false, 'error'=>"$e->getMessage()"));
		}
		
	}
	//KisiTezSorgulama/id/date/tid/
	
	public function ozgecmisBapv1(Request $request){
		
		$service = Service::where('name', $request->route()->getAction('role'))->get();
		
		$user = JWTAuth::parseToken()->authenticate();
		
		$client = new \SoapClient("https://servisler.yok.gov.tr/ws/ozgecmisBapv1?wsdl");		
		try {
			$method = $request->route('method');
			
			$params = array(
								'kontrol' => array(
									'P_KULLANICI_ID' => $service[0]['account'],
									'P_SIFRE' => $service[0]['password'],
									'P_TC_KIMLIK_NO' => $user['tckimlikno']
								),
								"P_UNV_PROJE_NO" => $request->route('id'),
								"YOK_PROJE_ID" => $request->route('id')
							);
			$result = $client->__soapCall($method, array($params));
			
			return response()->json($result);
		}catch (Exception $e){
			return response()->json(array('success'=>false, 'error'=>"$e->getMessage()"));
		}
		
	}
	//getBapProjeBilgi/P_UNV_PROJE_NO
	//getBapProjeEkipListe/YOK_PROJE_ID
	//insertOrUpdateBapProje/P_UNV_PROJE_NO/P_PROJE_ADI/P_PROJE_ALANI/P_PROJE_BAS_TAR/P_PROJE_BIT_TAR/P_OZET/P_ANAHTAR_KELIME/P_BIRIM_ID/P_PARA_BIRIMI/P_BUTCE/P_YOK_PROJE_ID //update
	//deleteBapProjeOrEkip/P_SILINME_YERI/P_UNV_PROJE_NO/P_PROJE_EKIP_ID
    //insertOrUpdateBapProjeEkip/P_YOKPROJEID/P_ARASTIRMACI_TIP/P_ARASTIRMACI_TC/P_PROJEDEKI_GOREVI/P_PERSONEL_AD/P_PERSONEL_SOYAD/P_PROJE_EKIP_ID
	
	public function yokdil(Request $request){
		
		$service = Service::where('name', $request->route()->getAction('role'))->get();
		
		$account = array(
			 'login' => $service[0]['account2'],
			 'password' => $service[0]['password2']
		);
			
		try {
			
			$request_ = Request::create( 'https://servisler.yok.gov.tr/yokdil/OgrencininSinavlariniGetir', 'GET', $account, $cookies = array(), $files = array(), $server = array(), $content = null );
			$response = Route::dispatch( $request_ );
			
			
			return response()->json($result);
		}catch (Exception $e){
			return response()->json(array('success'=>false, 'error'=>"$e->getMessage()"));
		}
		
	}
	//yokdil/OgrencininSinavlariniGetir
}
