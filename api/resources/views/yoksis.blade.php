@extends('main')

@section('title')
kps
@endsection

@section('content')
						
						<div class="card border-primary">
							<div class="card-body">
								<h4 class="card-title">GET https://localhost/api/Yoksis/UniversiteBirimlerv4/{method}</h4> 
								<h4 class="card-title">GET https://localhost/api/Yoksis/UniversiteBirimlerv4/{method}/{id}</h4>
								<h4 class="card-title">GET https://localhost/api/Yoksis/UniversiteBirimlerv4/{method}/{gun}/{ay}/{yil}</h4>
								<hr />
								<big><big>
									<footer class="blockquote-footer">{method}: <cite title="Source Title">Kullanılabilir metodlar</cite></footer>
									<footer class="blockquote-footer">{id}: <cite title="Source Title">Yöksis BIRIM_ID</cite></footer>
									<footer class="blockquote-footer">{gun}: <cite title="Source Title">gun,</cite></footer>
									<footer class="blockquote-footer">{ay}: <cite title="Source Title">ay,</cite></footer>
									<footer class="blockquote-footer">{yil}: <cite title="Source Title">yil tarihinden itibaren birim değişikliklerini getirir.</cite></footer>
								</big></big>
							</div>
						</div>
						<div class="alert alert-info">
							<button type="button" class="close" data-dismiss="alert"></button>
							<h4 class="alert-heading">Metodlar!</h4>
							<p class="mb-0">
<xmp> 
UniversiteleriGetirv4
IDdenBirimAdiGetirv4/{id}
TarihtenBirimDegisiklikGetirv4/{gun}/{ay}/{yil}
AltBirimleriGetirv4/{id}
AltBirimdekiProgramlariGetirv4/{id}
</xmp></p>
						</div>
						
						<div class="card border-primary">
							<div class="card-body">		
								<h4 class="card-title">GET https://localhost/api/Yoksis/Ozgecmisv1/{method}/{id}</h4> 
								<h4 class="card-title">GET https://localhost/api/Yoksis/Ozgecmisv1/{method}/{date}/{id}</h4>
								<hr />
								<big><big>
									<footer class="blockquote-footer">{method}: <cite title="Source Title">Kullanılabilir metodlar</cite></footer>
									<footer class="blockquote-footer">{id}: <cite title="Source Title">TCKimlikNo</cite></footer>
									<footer class="blockquote-footer">{date}: <cite title="Source Title">tarihinden itibaren değişikliklerini getirir.</cite></footer>
								</big></big>
								</div>
						</div>
						<div class="alert alert-info">
							<button type="button" class="close" data-dismiss="alert"></button>
							<h4 class="alert-heading">Metodlar!</h4>
							<p class="mb-0">
<xmp> 
getirAkademikGorevListesi/{id}
getArastirmaSertifkaBilgisiV1/{id}
getirUnvDisiDeneyimListesi/{id}
getirDersListesi/{id}
getEditorlukBilgisiV1/{id}
getirIdariGorevListesi/{id}
getKitapBilgisiV1/{id}
getMakaleBilgisiV1/{id}
getOdulListesiV1/{id}
getirOgrenimBilgisiListesi/{id}
getPatentBilgisiV1/{id}
getirProjeListesi/{id}
getTasarimBilgisiV1/{id}
getTemelAlanBilgisiV1/{id}
getirTezDanismanListesi/{id}
getirUyelikListesi/{id}
getirYabanciDilListesi/{id}
getYazarListesiV1/{id}
getPersonelLinkV1/{id}
getSanatsalFaalV1/{id}
getHakemlikBilgisiV1/{id}
getBildiriBilgisiV1/{id}
getirBeyanTesvik/{id}
getirBasvuruDurum/{id}
getirAtifSayilari/{id}
getTesvikKatsayi/{id}
</xmp></p>
						</div>
						
						<div class="card border-primary">
							<div class="card-body">		
								<h4 class="card-title">GET https://localhost/api/Yoksis/UniversiteAkademikPersonelv1/{method}</h4> 
								<h4 class="card-title">GET https://localhost/api/Yoksis/UniversiteAkademikPersonelv1/{method}/{id | page}</h4>
								<hr />
								<big><big>
									<footer class="blockquote-footer">{method}: <cite title="Source Title">Kullanılabilir metodlar...</cite></footer>
									<footer class="blockquote-footer">{id}: <cite title="Source Title">AKPER_TC_KIMLIK_NO</cite></footer>
									<footer class="blockquote-footer">{page}: <cite title="Source Title">kullaniciyaGoreUniversiteki_Akademik_Personel_SayfaSayisiv1 metodu ile gelen sayfa bilgisi...</cite></footer>
									
									<footer class="blockquote-footer">SORGULAYAN_TC_KIMLIK_NO: <cite title="Source Title">User tablosundaki account bilgisi...</cite></footer>
								</big></big>
								</div>
						</div>
						<div class="alert alert-info">
							<button type="button" class="close" data-dismiss="alert"></button>
							<h4 class="alert-heading">Metodlar!</h4>
							<p class="mb-0">
<xmp> 
kullaniciyaGoreTcKimlikNodan_Akademik_Personel_Bilgisiv1/{id}/{id2}
kullaniciyaGoreUniversitedeki_Akademik_Personel_Bilgisiv1/{id}/{page}
kullaniciyaGoreUniversiteki_Akademik_Personel_SayfaSayisiv1/{id}
getMernisUyruk/{id}
</xmp></p>
						</div>
						
						<div class="card border-primary">
							<div class="card-body">	
								<h4 class="card-title">GET https://localhost/api/Yoksis/TcKimlikNoileMezunOgrenciSorgulav2/{method}/{id}</h4> 
								<hr />
								<big><big>
									<footer class="blockquote-footer">{method}: <cite title="Source Title">Kullanılabilir metodlar</cite></footer>
									<footer class="blockquote-footer">{id}: <cite title="Source Title">TCKimlikNo</cite></footer>
								</big></big>
							</div>
						</div>
						<div class="alert alert-info">
							<button type="button" class="close" data-dismiss="alert"></button>
							<h4 class="alert-heading">Metodlar!</h4>
							<p class="mb-0">
<xmp> 
TcKimlikNoilMezunOgrenciSorgulav2/{id}
</xmp></p>
						</div>
						
						<div class="card border-primary">
							<div class="card-body">	
								<h4 class="card-title">GET https://localhost/api/Yoksis/TcKimlikNoileOgrenciSorgulaDetayv4/{method}/{id}</h4> 
								<hr />
								<big><big>
									<footer class="blockquote-footer">{method}: <cite title="Source Title">Kullanılabilir metodlar</cite></footer>
									<footer class="blockquote-footer">{id}: <cite title="Source Title">TCKimlikNo</cite></footer>
								</big></big>
							</div>
						</div>
						<div class="alert alert-info">
							<button type="button" class="close" data-dismiss="alert"></button>
							<h4 class="alert-heading">Metodlar!</h4>
							<p class="mb-0">
<xmp> 
TcKimlikNoileOgrenciSorgulaDetayv4/{id}
</xmp></p>
						</div>
						
@include('help')						
	
						<div class="alert alert-info">
							<button type="button" class="close" data-dismiss="alert"></button>
							<h4 class="alert-heading">Başarılı!</h4>
							<p class="mb-0">
<xmp> 
{
    "SinavGrupBilgileriniGetirResult": {
        "Aciklama": null,
        "SonucKodu": "Basarili",
        "Sonuc": {
            "SinavGrupBilgi": [
				...
</xmp></p>
						</div>
						
@endsection					
