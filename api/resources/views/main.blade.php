<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
	<title>API Yardım - @yield('title')</title>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSS (load bootstrap) -->
    <link rel="stylesheet" href="https://bootswatch.com/4/simplex/bootstrap.css">
    <link rel="stylesheet" href="https://bootswatch.com/_assets/css/custom.min.css">
	<link rel="icon" href="https://omuservices.omu.edu.tr/app/favicon.png">	
</head>
        
<body>
	
	<div class="navbar navbar-expand-lg fixed-top navbar-light bg-light">
        <div class="container">
            <a href="./" class="navbar-brand">API Yardım</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a href="kps" class="nav-link">KPS</a>
                    </li>
                    <li class="nav-item">
                        <a href="osym" class="nav-link">ÖSYM</a>
                    </li>
					<li class="nav-item">
                        <a href="yoksis" class="nav-link">YÖKSİS</a>
                    </li>
					<li class="nav-item">
                        <a href="detsis" class="nav-link">DETSİS</a>
                    </li>
                </ul>
            </div>
			
        </div>
		
    </div>
	
	<div class="container">
		<div class="bs-docs-section" style="margin-top: -3em;">
			<div class="row">
				<div class="col-lg-12">
					<div class="bs-component">
					
						<ol class="breadcrumb">
							@if(trim($__env->yieldContent('title')) !== 'api')
							<li class="breadcrumb-item"><a href="./">api</a></li>
							<li class="breadcrumb-item active">@yield('title')</li>
							@else
							<li class="breadcrumb-item active">api</li>	
							@endif
						</ol>
						
						@yield('content')
	
					</div>
				</div>
			</div>
		</div>
	</div>
	
	
<script src="https://bootswatch.com/_vendor/jquery/dist/jquery.min.js"></script>
<script src="https://bootswatch.com/_vendor/bootstrap/dist/js/bootstrap.min.js"></script>	
</body>
</html>
