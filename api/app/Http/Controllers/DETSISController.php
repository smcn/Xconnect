<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Service;

class DETSISController extends Controller
{
    public function DETSISServis(Request $request){
		
		$service = Service::where('name', $request->route()->getAction('role'))->get();
		
		$client = new \SoapClient("https://bbws.kaysis.gov.tr/DETSISServis.asmx?WSDL");
		
		$header = new \SOAPHeader('http://kaysis.gov.tr/', 
								'BbServiceAuthentication', 
								array(
										'KurumID' => $service[0]['account'], 
										'Password' => $service[0]['password']
									 )
								);
		   
		$client->__setSoapHeaders($header); 
			
		try {
			$method = $request->route('method');
			$params = array('detsisId'=> $request->route('id'),
							'ad'=> $request->route('search'),
							'anaKurumIdareKimlikKodu'=> $request->route('id')
							);
			
			$result = $client->__soapCall($method, array($params));
			
			return response()->json($result);
		}catch (Exception $e){
			return response()->json(array('success'=>false, 'error'=>"$e->getMessage()"));
		}
		
	}
	//AdaGoreKurumBirimSorgulaWs
	//AnaKurumlariGetirKurumBirimWs
	//AnaKurumIletisimBilgileriWs
	//DETSISNoKurumBirimWs
	//DetayBilgilereGoreSorgulaKurumBirimWs
	
	//DetsisIslemYetkilisiBilgileriWs
	
	//HiyerarsiGetirKurumBirimWs
	//KEPAdresleriniGetir
	
	//KendiTumBirimleriGetirWs/{id}
	//KurumBirimIletisimBilgileriGetirWs/{id}
	
	//TumTip1KodlariGetirWs
	//TumTip2KodlariGetirWs
	//TumYerKodlariGetirWs
	
	//YeniDisYazismaYapanlariGetirWs/pGun/pAy/pYil
	
	//eYazismaPaketi

	//AktifKEPAdresleriniGetir	
	
}
