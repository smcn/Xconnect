// app.js

var routerApp = angular.module('routerApp', ['ui.router', 'angular-jwt', 'angular-loading-bar']);
routerApp.run(function ($rootScope) {
	$rootScope.isAdmin = 0;
	$rootScope.serviceBaseURL = "https://omuservices.omu.edu.tr/api/";
});

routerApp.config(function ($stateProvider, $urlRouterProvider) {
    $stateProvider  
        .state("login", {
            url: "/login",
            templateUrl: "views/login.html",
            controller: "loginController"
        })
		.state('users', {
            url: '/users',
            templateUrl: 'views/users.html',
            controller: 'userController'
        })
		.state('services', {
            url: '/services',
			templateUrl: 'views/services.html',
            controller: "serviceController"
        })
		.state("records", {
            url: "/records",
            templateUrl: "views/records.html",
            controller: "recordController"
        })
		.state("logout", {
            url: "/logout",
            templateUrl: "",
            controller: "logoutController"
        });
    
    $urlRouterProvider.otherwise("/login");
});
