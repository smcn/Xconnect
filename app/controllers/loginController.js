// loginController.js

routerApp.controller("loginController", function ($rootScope, $scope, $http, $state, jwtHelper, $window) {
	
    $scope.login = function (Users) {	
		if(Users){
			
			myobject = { 'email': Users.email, 'password': Users.password };
			return $http({
				method: 'POST',
				headers: {
					"content-type": "application/json",
                    "accept": "application/json"
				},
				url: $rootScope.serviceBaseURL + 'login',
				data: myobject
			}).success(function (data, status) {	
				if (data.token) {
					$rootScope.isAdmin = 1;
					$window.localStorage.setItem('token', data.token);
					$state.go("users");
				} else {
					$rootScope.isAdmin = 0;
					$scope.msg = data['status'];
					$scope.status = status;
				}
				
			}).error(function (data, status) {
				$scope.msg = data['status'];
				$scope.status = status;
			});
        }
    }
});

