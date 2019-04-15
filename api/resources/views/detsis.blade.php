@extends('main')

@section('title')
kps
@endsection

@section('content')
						
						<div class="card border-primary">
							<div class="card-body">
								<h4 class="card-title">GET https://localhost/api/DETSIS/DETSISServis/{method}</h4> 
								<h4 class="card-title">GET https://localhost/api/DETSIS/DETSISServis/{method}/{id}</h4>
								<h4 class="card-title">GET https://localhost/api/DETSIS/DETSISServis/{method}/{search}/{id}</h4>
								<big><big>
									<footer class="blockquote-footer">{method}: <cite title="Source Title">Kullanılabilir metodlar</cite></footer>
									<footer class="blockquote-footer">{id}: <cite title="Source Title">DetsisNo</cite></footer>
									<footer class="blockquote-footer">{search}: <cite title="Source Title">Arama kelimesi</cite></footer>
								</big></big>
							</div>
						</div>
						
												<div class="alert alert-info">
							<button type="button" class="close" data-dismiss="alert"></button>
							<h4 class="alert-heading">Metodlar!</h4>
							<p class="mb-0">
<xmp> 
AdaGoreKurumBirimSorgulaWs/{ad(en az 5 harf)}/anaKurumIdareKimlikKodu(root için 0)
AktifKEPAdresleriniGetir
AnaKurumlariGetirKurumBirimWs
AnaKurumIletisimBilgileriWs
DETSISNoKurumBirimWs
DetayBilgilereGoreSorgulaKurumBirimWs
DetsisIslemYetkilisiBilgileriWs
HiyerarsiGetirKurumBirimWs/{id}
KEPAdresleriniGetir
KendiTumBirimleriGetirWs/{id}
KurumBirimIletisimBilgileriGetirWs/{id}
TumTip1KodlariGetirWs
TumTip2KodlariGetirWs
TumYerKodlariGetirWs
//YeniDisYazismaYapanlariGetirWs/pGun/pAy/pYil
//eYazismaPaketi
</xmp></p>
						</div>
						
@include('help')						
	
						<div class="alert alert-info">
							<button type="button" class="close" data-dismiss="alert"></button>
							<h4 class="alert-heading">Başarılı!</h4>
							<p class="mb-0">
<xmp> 
{
    "DetsisIslemYetkilisiBilgileriWsResult": {
        "SonucHatali": false,
        "Sonuclar": {
            "DetsisKullanici": [
				...
				
{
    "AdaGoreKurumBirimSorgulaWsResult": {
        "SonucHatali": false,
        "Sonuclar": {
            "KurumBirimWS": [
                {
                    "DETSISNo": 123,
                    "Ad": "ONDOKUZ MAYIS ÜNİVERSİTESİ REKTÖRLÜĞÜ",
</xmp></p>
						</div>
						
@endsection					
