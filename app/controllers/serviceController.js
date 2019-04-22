// serviceController.js

routerApp.controller("serviceController", function ($rootScope, $scope, $http, $state, $window, recordService) {
	
	var errorMgs = ["Token is Invalid", "Token is Expired", "Authorization Token not found", "User not found", "Unauthorized", "Record table write error"];
	
    $http({
        method: 'GET',
        headers: {
            "authorization": "Bearer " + $window.localStorage.getItem('token'),
            "content-type": "application/json",
            "accept": "application/json"
        },
        url: $rootScope.serviceBaseURL + 'service/all'
    }).success(function (data) {
		if( errorMgs.indexOf(data['status']) !== -1 ){
			$rootScope.isAdmin = 0;
			$scope.msg = data['status'];
			$scope.status = status;
		}else{
			$rootScope.isAdmin = 1;
			$scope.services = data['services'];
		}
        
    }).error(function (data, status) {
        $scope.msg = data;
		$scope.status = status;
    });

   
    $scope.addService = function () {
        if ($scope.newService.name && $scope.newService.account && $scope.newService.password && $scope.newService.description) {
            
            return $http({
                method: 'POST',
                headers: {
                    "authorization": "Bearer " + $window.localStorage.getItem('token'),
                    "content-type": "application/json",
                    "accept": "application/json"
                },
                url: $rootScope.serviceBaseURL + 'service/add',
                data: $scope.newService
            }).success(function (data) {
                                               
				$scope.services.push(data.service);
               
            }).error(function (data, status) {
                $scope.msg = data;
				$scope.status = status;
            });
        }
    };
	
	$scope.updateService = function ($items) {
        if ($items.id && $items.account && $items.password && $items.description) {
          
            return $http({
                method: 'PUT',
                headers: {
                    "authorization": "Bearer " + $window.localStorage.getItem('token'),
                    "content-type": "application/json",
                    "accept": "application/json"
                },
                url: $rootScope.serviceBaseURL + 'service/update',
                data: $items
            }).success(function (data) {
                                               
                //console.log(data);

            }).error(function (data, status) {
                $scope.msg = data;
				$scope.status = status;
            });
			
        }
    };
	
	$scope.deleteService = function (id, index) {
        if (id) {
            
			$scope.services.splice(index, 1);
		
            return $http({
                method: 'DELETE',
                headers: {
                    "authorization": "Bearer " + $window.localStorage.getItem('token'),
                    "content-type": "application/json",
                    "accept": "application/json"
                },
                url: $rootScope.serviceBaseURL + 'service/delete',
                data: { "id":id }
            }).success(function (data) {
                                               
                //console.log(data);

            }).error(function (data, status) {
                $scope.msg = data;
				$scope.status = status;
            });
        }
    };
	
	$scope.getServiceRecords = function (id) {
		
        if (id) {
           
            return $http({
				method: 'GET',
				headers: {
					"authorization": "Bearer " + $window.localStorage.getItem('token'),
					"content-type": "application/json",
					"accept": "application/json"
				},
				url: $rootScope.serviceBaseURL + 'record/service/'+id
			}).success(function (data, status) {
				
				if( errorMgs.indexOf(data['status']) !== -1 ){
					$rootScope.isAdmin = 0;
					$scope.msg = data['status'];
					$scope.status = status;
				}else{
					$rootScope.isAdmin = 1;
					recordService.setTemp(data['records']);
					$state.go("records");
				}
				
			}).error(function (data, status) {
				$scope.msg = data;
				$scope.status = status;
			});
        }
    };
	
	
	
});
