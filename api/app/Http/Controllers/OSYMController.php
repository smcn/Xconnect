<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Service;
use App\Http\Controllers\SoapOsymHeader\SoapOsymHeader;

class OSYMController extends Controller
{
    public function BilgiServisi(Request $request){
		
		$service = Service::where('name', $request->route()->getAction('role'))->get();
		
		$username = $service[0]['account'];
		$password = $service[0]['password']; 
		
		$client = new \SoapClient("https://vps.osym.gov.tr/Ext/Provider/BilgiServisi/Sonuc?wsdl", array(
					  'login' => $username,
					  'password' => $password
					 ));
		
		$method = $request->route('method');
		$params = array('adayTcKimlikNo'=> $request->route('id'), 
						'yil' => $request->route('year'), 'sonucId' => $request->route('resultId'),
						'sinavGrupId' => $request->route('groupId')
						);
		
		try {
		
			$client->__setSoapHeaders([new SoapOsymHeader($username, $password)]);
			$result = $client->__soapCall($method, array($params));
			return response()->json($result);
		}catch (Exception $e){
			return response()->json(array('success'=>false, 'error'=>"$e->getMessage()"));
		}
		
	}
	//SinavGrupBilgileriniGetir
	//SinavSonucHtml/adayTcKimlikNo/sonucId
	//SinavSonucXml/adayTcKimlikNo/sonucId
	//SinavSonucHtml/adayTcKimlikNo/sonucId
	//SinavSonuclariGetir/adayTcKimlikNo/yil/sinavGrupId
	
}
