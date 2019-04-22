// recordController.js

routerApp.controller("recordController", function ($rootScope, $scope, $http, $state, $window, recordService) {
    if(! recordService.getTemp() ){
		var errorMgs = ["Token is Invalid", "Token is Expired", "Authorization Token not found", "User not found", "Unauthorized", "Record table write error"];
		
		$http({
			method: 'GET',
			headers: {
				"authorization": "Bearer " + $window.localStorage.getItem('token'),
				"content-type": "application/json",
				"accept": "application/json"
			},
			url: $rootScope.serviceBaseURL + 'record/all'
		}).success(function (data, status) {
			if( errorMgs.indexOf(data['status']) !== -1 ){
				$rootScope.isAdmin = 0;
				$scope.msg = data['status'];
				$scope.status = status;
			}else{
				$rootScope.isAdmin = 1;
				$scope.records = data['records'];
			}
			
		}).error(function (data, status) {
			$scope.msg = data;
			$scope.status = status;
		});
	}else{
		$rootScope.isAdmin = 1;
		$scope.records = recordService.getTemp();
		recordService.setTemp(null);
	}
	
	$scope.searchText = function () {

		if ($scope.search) {
            return $http({
				method: 'GET',
				headers: {
					"authorization": "Bearer " + $window.localStorage.getItem('token'),
					"content-type": "application/json",
					"accept": "application/json"
				},
				url: $rootScope.serviceBaseURL + 'record/search/'+$scope.search
			}).success(function (data, status) {
				
				if( errorMgs.indexOf(data['status']) !== -1 ){
					$rootScope.isAdmin = 0;
					$scope.msg = data['status'];
					$scope.status = status;
				}else{
					$rootScope.isAdmin = 1;
					$scope.records = data['records'];
					$state.go("records");
				}
				
			}).error(function (data, status) {
				$scope.msg = data;
				$scope.status = status;
			});
        }
    };
	
});