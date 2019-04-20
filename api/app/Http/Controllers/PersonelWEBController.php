<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\OMUDBClass\UBSPersonel;
use App\Http\Controllers\OMUDBClass\Yoksis;

class PersonelWEBController extends Controller
{
    private function enc($str)
	{
		if(is_string($str))
			return mb_convert_encoding($str,"utf-8","iso-8859-9");
		else
			return;
	} 
	
	public function getAll(Request $request){
		
		$fakulte = $request->route('fakulte');
		$bolum = $request->route('bolum');
		$anabilimdali = $request->route('anabilimdali');
		$dil = $request->route('dil');
		
		$s = "select
		(select Adi from Organizasyon cy 
		where cy.Kurulus = Organizasyon.Kurulus 
		and cy.Birim = 0 
		and cy.AltBirim = 0) fakulte,
		(select Adi from Organizasyon cy 
		where cy.Kurulus = Organizasyon.Kurulus 
		and cy.Birim = Organizasyon.Birim 
		and cy.AltBirim = 0) bolum, 
		Organizasyon.Adi as anabilimdali,
		Personel.KimlikNo, 
		-- Personel.personelID, 
		Personel.Adi, Personel.Soyadi, Unvan.Sinif,
		Unvan.UnvanID, Unvan.Adi as Unvan, 
		Kod.KodID, Kod.Aciklama as Gorev,
		Adres.isTelefonu, Adres.EMail,
		-- Memur.CalistigiOrganizasyon, 
		-- Kadro.Organizasyon as KadroOrganizasyon,  
		-- CalistigiYer.Kurulus, CalistigiYer.Birim, CalistigiYer.AltBirim, 
		-- CalistigiYer.OrganizasyonID, 
		NufusImage.Foto img
		from Personel 
		left join Memur on Memur.Personel = Personel.PersonelID 
		left join Kadro on Kadro.KadroID = Memur.Kadro 
		left join Unvan on Unvan.UnvanID = Kadro.Unvan 
		-- left join CalistigiYer on CalistigiYer.OrganizasyonID = Kadro.Organizasyon
		left join Organizasyon on Organizasyon.OrganizasyonID = Kadro.Organizasyon
		left join Kod on Kod.KodID = Memur.GorevUnvanKodu
		left join Nufus on Nufus.Personel = Personel.PersonelID
		left join NufusImage on NufusImage.Nufus = Nufus.NufusID
		left join Adres on Personel.PersonelID = Adres.Personel and Adres.AdresTuru = 2000500001
		where Personel.Aktif = 1 and Unvan.Sinif = '100700011' and Organizasyon.Kurulus = :fakulte ";

		$arr = array(':fakulte' => $fakulte);

		if ( isset($bolum) && ($bolum != '') && ($bolum != 0) ){
			$s .= 'and  Organizasyon.Birim = :bolum ';
			//$arr += [ ':bolum' => $bolum ]
			$arr[':bolum'] = $bolum;
			//array_push($arr, ':bolum' => $bolum);
		}
		if ( isset($anabilimdali) && ($anabilimdali != '') && ($anabilimdali != 0) ){
			$s .= 'and Organizasyon.AltBirim = :anabilimdali ';
			//$arr += [ ':anabilimdali' => $anabilimdali ]
			$arr[':anabilimdali'] = $anabilimdali;
			//array_push($arr, ':anabilimdali' => $anabilimdali);
		}

		$unvan = array('ÖĞRETİM GÖREVLİSİ' => 'Instructor',
		'ARAŞTIRMA GÖREVLİSİ' => 'Research Assistant',
		'DOKTOR ÖĞRETİM ÜYESİ' => 'Faculty Member',
		'PROFESÖR' => 'Professor',
		'DOÇENT' => 'Associate Professor');	

		$msdb = new UBSPersonel();
		//concat(tal.ANAHTARKELIME1_AD, tal.ANAHTARKELIME2_AD, tal.ANAHTARKELIME3_AD) BILIM_ALAN_AD
		$yoksis = new Yoksis();
		$ss = 'select 
		pll.YOKAKADEMIK_LINK, tal.BILIM_ALAN_AD BILIM_ALAN_AD, 
		concat_ws(" / ", tal.ANAHTARKELIME1_AD,  tal.ANAHTARKELIME2_AD, tal.ANAHTARKELIME3_AD) ANAHTARKELIME_AD, 
		pll.PERSONEL_RESIM_LINK,
		ba.en bilimalan_en, 
		concat_ws(" / ", ak1.en,  ak2.en, ak3.en) anahtar_en
		from personelLinkListe pll
		left join temelAlanListe tal on  tal.TC_KIMLIK_NO = pll.TC_KIMLIK_NO and tal.AKTIF_PASIF = 1
		left join bilimAlan ba on ba.id = tal.BILIM_ALAN_ID
		left join anahtarKelime ak1 on ak1.id = tal.ANAHTARKELIME1_ID
		left join anahtarKelime ak2 on ak2.id = tal.ANAHTARKELIME1_ID
		left join anahtarKelime ak3 on ak3.id = tal.ANAHTARKELIME1_ID
		where pll.TC_KIMLIK_NO = :tc ';
		//echo $s;print_r($arr);
		$personel = $msdb->getRows($s ." order by Unvan.UnvanID, Personel.Soyadi, Personel.Adi", $arr);
		$i = 0;
		foreach($personel as $perso){
			$personel[$i]['fakulte'] = $this->enc(trim($personel[$i]['fakulte']));
			$personel[$i]['bolum'] = $this->enc(trim($personel[$i]['bolum']));
			$personel[$i]['anabilimdali'] = $this->enc(trim($personel[$i]['anabilimdali']));
			$personel[$i]['Adi'] = mb_convert_case(str_replace( array('i','I'), array('İ','ı'), $this->enc(trim($personel[$i]['Adi'])) ), MB_CASE_TITLE, "UTF-8");
			$personel[$i]['Soyadi'] = $this->enc(trim($personel[$i]['Soyadi']));
			if($dil == 'tr')
				$personel[$i]['Unvan'] = mb_convert_case(str_replace( array('i','I'), array('İ','ı'), $this->enc(trim($personel[$i]['Unvan'])) ), MB_CASE_TITLE, "UTF-8"); 
			else
				$personel[$i]['Unvan'] = @mb_convert_case(str_replace( array('i','I'), array('İ','ı'), $unvan[$this->enc(trim($personel[$i]['Unvan']))] ), MB_CASE_TITLE, "UTF-8"); 
			$personel[$i]['Gorev'] = mb_convert_case(str_replace( array('i','I'), array('İ','ı'), $this->enc(trim($personel[$i]['Gorev'])) ), MB_CASE_TITLE, "UTF-8");
			$personel[$i]['img'] = base64_encode($personel[$i]['img']);
			//$personel[$i]['eposta'] = eposta($personel[$i]['KimlikNo']);
			$parts = explode("@", $personel[$i]['EMail']);
			$personel[$i]['eposta'] = $parts[0];
			
			$l = $yoksis->getRow($ss, array(':tc' => $personel[$i]['KimlikNo']));
			$personel[$i]['link'] = $l['YOKAKADEMIK_LINK'];
			if($dil == 'tr'){
				$personel[$i]['temelalan'] = $l['BILIM_ALAN_AD'];
				$personel[$i]['bilimalan'] = $l['ANAHTARKELIME_AD'];
			}else{
				$personel[$i]['temelalan'] = $l['bilimalan_en'];
				$personel[$i]['bilimalan'] = $l['anahtar_en'];
			}
			$personel[$i]['resimlink'] = empty($l['PERSONEL_RESIM_LINK'])?'':$l['PERSONEL_RESIM_LINK'];
			$personel[$i]['KimlikNo'] = null;
			$i++;
		}
		
		return response()->json($personel);
	}

}
