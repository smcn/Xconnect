// loginController.js

routerApp.controller("loginController", function ($rootScope, $scope, $http, $state, jwtHelper, $window) {
	
    $scope.login = function (Users) {	
		if(Users){
			
			myobject = { 'email': Users.email, 'password': Users.password };
			console.log(myobject);
			return $http({
				method: 'POST',
				headers: {
					"content-type": "application/json",
                    "accept": "application/json"
				},
				url: $rootScope.serviceBaseURL + 'login',
				data: myobject
			}).success(function (data, status) {	
			
				tokenPayload = jwtHelper.decodeToken(data.token);
				console.log(tokenPayload);
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

