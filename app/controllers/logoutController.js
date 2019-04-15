// logoutController.js

routerApp.controller('logoutController', function($rootScope, $state, $window){
	$window.localStorage.removeItem('token');  
	$rootScope.isAdmin = 0;
	$state.go("login");
})
