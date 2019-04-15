@extends('main')

@section('title')
api
@endsection

@section('content')

						<div class="alert alert-primary">
							<button type="button" class="close" data-dismiss="alert"></button>
							<h4 class="alert-heading">GitHub!</h4>
							<p class="mb-0">Projenin GitHub Sayfası <a href="https://github.com/smcn/" class="alert-link">https://github.com/smcn/</a>.</p>
						</div>
						
						<big>
						<div class="card border-primary">
							<div class="card-body">
								<h4 class="card-title">POST https://localhost/api/login</h4>
								
								<p class="card-text">GuzzleHttp Örnek</p>
								<div class="card border-primary">
									<div class="card-body">
								
								
<xmp>
function getJWTToken() {
	$response = $this->client->request('POST', $this->baseApiURL .'login', 
		[
			'form_params' => ['email' => $this->email, 'password' => $this->password], 
			'verify' => false
		]
	);
	$token = json_decode($response->getBody(), true);
	return $this->token = (isset($token['token'])?$token['token']:'');
}
</xmp>
									</div>
								</div>
								
								<p class="card-text">AngularJS Örnek</p>
								<div class="card border-primary">
									<div class="card-body">
								
								
<xmp>
myobject = { 'email': Users.email, 'password': Users.password };

Object.toparams = function ObjecttoParams(obj) {
	var p = [];
	for (var key in obj) {
		p.push(key + '=' + encodeURIComponent(obj[key]));
	}
	return p.join('&');
};

return $http({
	method: 'POST',
	headers: {
		'Content-Type': 'application/x-www-form-urlencoded'
	},
	url: $rootScope.serviceBaseURL + 'login',
	data: Object.toparams(myobject)
}).success(function (data, status) {	
	tokenPayload = jwtHelper.decodeToken(data.token);
	$window.localStorage.setItem('token', data.token);
}).error(function (data, status, headers, config) {
	console.log("Hata: " + JSON.stringify({ data: data }));
});
</xmp>
									</div>
								</div>
								
								
							</div>
						</div>

						<div class="alert alert-info">
							<button type="button" class="close" data-dismiss="alert"></button>
							<h4 class="alert-heading">Doğrulayıcı!</h4>
							<p class="mb-0">
<xmp> 
$validator = Validator::make($request->all(), [
	'name' => 'required|string|max:255',
	'email' => 'required|string|email|max:255|unique:users',
	'password' => 'required|string|min:6',
	'role' => 'required|string|max:255',
]);
</xmp></p>
						</div>
						
						<div class="alert alert-primary">
							<button type="button" class="close" data-dismiss="alert"></button>
							<h4 class="alert-heading">Hatalar!</h4>
							<p class="mb-0">
<xmp> 
{ 
	"status": "Invalid Credentials" 
} 
, 
{ 	
	"status": "User is passive" 
} 
, 
{ 	
	"status": "Could Not Create Token" 
} 
</xmp></p>
						</div>
						
						<div class="alert alert-info">
							<button type="button" class="close" data-dismiss="alert"></button>
							<h4 class="alert-heading">Başarılı!</h4>
							<p class="mb-0">
<xmp> 
{
    "token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.ey..."
} 
</xmp></p>
						</div>
						</big>
						<!--div class="jumbotron">
							<h4 class="display-4">Hello, world!</h4>
							<p class="lead">This is a simple hero unit, a simple jumbotron-style component for calling extra attention to featured content or information.</p>
							<hr class="my-4">
							<p>It uses utility classes for typography and spacing to space content out within the larger container.</p>
							<p class="lead">
								<a class="btn btn-primary btn-lg" href="#" role="button">Learn more</a>
							</p>
						</div-->
						
@endsection					
