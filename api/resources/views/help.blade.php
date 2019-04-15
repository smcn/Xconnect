						
						<big>
						<div class="card border-primary">
							<div class="card-body">						
								<p class="card-text">GuzzleHttp Örnek</p>
								<div class="card border-primary">
									<div class="card-body">
																
<xmp>
function apiClient() {		
	$response = $this->client->request('GET', $this->baseApiURL .$this->apiURL,
		[
			'headers' => ['Authorization' => 'Bearer '.$this->token],
			'verify' => false
		]
	);
	return json_decode($response->getBody(), true);
}
</xmp>
									</div>
								</div>
								
								<p class="card-text">AngularJS Örnek</p>
								<div class="card border-primary">
									<div class="card-body">
														
<xmp>
return $http({
	method: 'GET',
	headers: {
		"authorization": "Bearer " + $window.localStorage.getItem('token'),
		"content-type": "application/json",
		"accept": "application/json"
	},
	url: $rootScope.serviceBaseURL + 'BilesikKutukSorgulaKimlikNoServis/'+id
}).success(function (data, status) {
	console.log(data);
}).error(function (data, status) {
	console.log("Hata: " + JSON.stringify({ data: data }));
});
</xmp>
									</div>
								</div>
								
								
							</div>
						</div>
						
						<div class="alert alert-primary">
							<button type="button" class="close" data-dismiss="alert"></button>
							<h4 class="alert-heading">Hatalar!</h4>
							<p class="mb-0">
<xmp> 
{ 
	"status": "Token is Invalid" 
} 
, 
{ 	
	"status": "Token is Expired" 
} 
, 
{ 	
	"status": "Authorization Token not found" 
} 
, 
{ 	
	"status": "User not found" 
} 
, 
{ 	
	"status": "Unauthorized" 
} 
, 
{ 	
	"status": "Record table write error" 
} 
</xmp></p>
						</div>
						</big>
						
