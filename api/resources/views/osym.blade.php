@extends('main')

@section('title')
kps
@endsection

@section('content')
						
						<div class="card border-primary">
							<div class="card-body">
								<h4 class="card-title">GET https://localhost/api/OSYM/BilgiServisi/{method}</h4> 
								<h4 class="card-title">GET https://localhost/api/OSYM/BilgiServisi/{method}/{id}/{year}/{groupId}</h4>
								<h4 class="card-title">GET https://localhost/api/OSYM/BilgiServisi/{method}/{id}/{resultId}</h4>
								
								<big><big>
									<footer class="blockquote-footer">{method}: <cite title="Source Title">Kullanılabilir metodlar</cite></footer>
									<footer class="blockquote-footer">{id}: <cite title="Source Title">TCKimlikNo</cite></footer>
									<footer class="blockquote-footer">{resultId}: <cite title="Source Title">SinavSonuclariGetir metodu ile gelen resultId</cite></footer>
									<footer class="blockquote-footer">{year}: <cite title="Source Title">Yıl</cite></footer>
									<footer class="blockquote-footer">{groupId}: <cite title="Source Title">SinavGrupBilgileriniGetir metodu ile gelen ilgili groupId</cite></footer>
								
								</big></big>
							</div>
						</div>
						
												<div class="alert alert-info">
							<button type="button" class="close" data-dismiss="alert"></button>
							<h4 class="alert-heading">Metodlar!</h4>
							<p class="mb-0">
<xmp> 
SinavGrupBilgileriniGetir
SinavSonuclariGetir/{id}/{year}/{groupId}
SinavSonucHtml/{id}/{resultId}
SinavSonucXml/{id}/{resultId}
</xmp></p>
						</div>
						
@include('help')						
	
						<div class="alert alert-info">
							<button type="button" class="close" data-dismiss="alert"></button>
							<h4 class="alert-heading">Başarılı!</h4>
							<p class="mb-0">
<xmp> 
{
    "SinavSonucHtmlResult": {
        "Aciklama": "Herhangi bir veri yoktur.",
        "SonucKodu": "KayitBulunamadi",
        "Sonuc": null
    }
}
</xmp></p>
						</div>
						
@endsection					
