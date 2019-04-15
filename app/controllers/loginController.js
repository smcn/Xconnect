// loginController.js

routerApp.controller("loginController", function ($rootScope, $scope, $http, $state, jwtHelper, $window) {
	
    $scope.login = function (Users) {	
		if(Users){
			
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
				if (tokenPayload.role.indexOf('admin') !== -1) {
					$rootScope.isAdmin = 1;
					$window.localStorage.setItem('token', data.token);
					$state.go("users");
				} else {
					$rootScope.isAdmin = 0;
				}
				
			}).error(function (data, status, headers, config) {
				//console.log("Hata: " + JSON.stringify({ data: data }));
				if(status == 400){
					$scope.msg = data['status'];
					$scope.status = status;
				}
			});
        }
    }
});

