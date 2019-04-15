<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Service;

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
		
		$client = new \SoapClient("https://servisler.yok.gov.tr/ws/UniversiteAkademikPersonelv1?WSDL", $account);		
		try {
			$method = $request->route('method');
			$params = array('SORGULAYAN_TC_KIMLIK_NO'=> $request->route('id'), 
							'AKPER_TC_KIMLIK_NO' => $request->route('page'),
							'SAYFA' => $request->route('page')
							);
			
			$result = $client->__soapCall($method, array($params));
			
			return response()->json($result);
		}catch (Exception $e){
			return response()->json(array('success'=>false, 'error'=>"$e->getMessage()"));
		}
		
	}
	//kullaniciyaGoreTcKimlikNodan_Akademik_Personel_Bilgisiv1
	//kullaniciyaGoreUniversitedeki_Akademik_Personel_Bilgisiv1
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
	
	///////HATALI
	public function MEBMezunSorgulav2(Request $request){
		
		$service = Service::where('name', $request->route()->getAction('role'))->get();
		
		$client = new \SoapClient("https://servisler.yok.gov.tr/ws/mebmezunsorgulav2?WSDL");		
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
	
	
	
	
}
