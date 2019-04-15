@extends('main')

@section('title')
kps
@endsection

@section('content')
						
						<div class="card border-primary">
							<div class="card-body">
								<h4 class="card-title">GET https://localhost/api/KPS/BilesikKutukSorgulaKimlikNoServis/{id}</h4> 
								<h4 class="card-title">GET https://localhost/api/KPS/KimlikNoSorgulaAdresServis/{id}</h4>
								
								<big><big><footer class="blockquote-footer">{id}: <cite title="Source Title">TCKimlikNo</cite></footer></big></big>
							</div>
						</div>
						
@include('help')						
	
						<div class="alert alert-info">
							<button type="button" class="close" data-dismiss="alert"></button>
							<h4 class="alert-heading">Başarılı!</h4>
							<p class="mb-0">
<xmp> 
{
    "SorgulaResult": {
        "HataBilgisi": null,
        "SorguSonucu": {
            "BilesikKutukBilgileri": { 
				...
</xmp></p>
						</div>
						
@endsection					
