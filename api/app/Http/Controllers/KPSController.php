<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\KPSSoapClient\KPSSoapClient;
use App\Service;

class KPSController extends Controller
{
	
    public function BilesikKutukSorgulaKimlikNoServis(Request $request){
		$tcno=(double)$request->route('id');
		$service = Service::where('name', $request->route()->getAction('role'))->get();

		$username = $service[0]['account'];
		$password = $service[0]['password']; 
		
		$wsdl = "https://kpsbasvuru.nvi.gov.tr/Services/Wsdl.ashx?Service=BilesikKutukSorgulaKimlikNoServis";
		
		$kpsClient = new KPSSoapClient($username, $password, $wsdl);
		
		try {
			$result = $kpsClient->Sorgula(
					array(
							'kriterListesi' => array(
									'BilesikKutukSorgulaKimlikNoSorguKriteri' => array(
											'KimlikNo' => $tcno
									)
							)
					)
			);
			
			return response()->json($result);
		}catch (Exception $e){
			return response()->json(array('success'=>false, 'error'=>"$e->getMessage()"));
		}
			
	}
	
	public function KimlikNoSorgulaAdresServis(Request $request){
		$tcno=(double)$request->route('id');
		$service = Service::where('name', $request->route()->getAction('role'))->get();

		$username = $service[0]['account'];
		$password = $service[0]['password']; 
		$wsdl = "https://kpsbasvuru.nvi.gov.tr/Services/Wsdl.ashx?Service=KimlikNoSorgulaAdresServis&Version=2016/10/01";
		
		$kpsClient = new KPSSoapClient($username, $password, $wsdl);
		
		try {
			$result = $kpsClient->Sorgula(
				array(
					'kriterListesi' => array(
						'KimlikNoileAdresSorguKriteri' => array(
							'KimlikNo' => $tcno
						)
					)
				)
			);
			return response()->json($result);
		} catch (Exception $e){
			return response()->json(array('success'=>false, 'error'=>"$e->getMessage()"));
		}
		
	}
	
}
