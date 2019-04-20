// userController.js

routerApp.controller("userController", function ($rootScope, $scope, $http, $state, $window, recordService) {
    
	var errorMgs = ["Token is Invalid", "Token is Expired", "Authorization Token not found", "User not found", "Unauthorized", "Record table write error"];
	
	headers1= {
					"authorization": "Bearer " + $window.localStorage.getItem('token'),
					"content-type": "application/json",
					"accept": "application/json"
				};
	console.log(headers1);
    $http({
        method: 'GET',
        headers: {
            "authorization": "Bearer " + $window.localStorage.getItem('token'),
            "content-type": "application/json",
            "accept": "application/json"
        },
        url: $rootScope.serviceBaseURL + 'user/all'
    }).success(function (data, status) {
        
		if( errorMgs.indexOf(data['status']) !== -1 ){
			$rootScope.isAdmin = 0;
			$scope.msg = data['status'];
			$scope.status = status;
		}else{
			$rootScope.isAdmin = 1;
			$scope.users = data['users'];
			console.log(data);
		}
        
    }).error(function (data, status) {
		$scope.msg = data;
		$scope.status = status;
    });

   
    $scope.addUser = function () {
        if ($scope.newUser.name && $scope.newUser.email && $scope.newUser.password && $scope.newUser.role) {
            
            $scope.isAddForm = false;
            console.log($scope.newUser);
           
            return $http({
                method: 'POST',
                headers: {
                    "authorization": "Bearer " + $window.localStorage.getItem('token'),
                    "content-type": "application/json",
                    "accept": "application/json"
                },
                url: $rootScope.serviceBaseURL + 'user/add',
                data: $scope.newUser
            }).success(function (data) {
                                               
				$scope.users.push(data.user);
               
            }).error(function (data, status) {
				$scope.msg = data;
				$scope.status = status;
            });

        }
    };
	
	$scope.updateUser = function ($items) {
        if ($items.id && $items.name && $items.email && $items.password && $items.role && $items.active) {
            
            console.log($items);
         
            return $http({
                method: 'PUT',
                headers: {
                    "authorization": "Bearer " + $window.localStorage.getItem('token'),
                    "content-type": "application/json",
                    "accept": "application/json"
                },
                url: $rootScope.serviceBaseURL + 'user/update',
                data: $items
            }).success(function (data) {
                                               
                console.log(data);

            }).error(function (data, status) {
                $scope.msg = data;
				$scope.status = status;
				console.log(data);
            });

        }
    };
	
	$scope.deleteUser = function ($id, $index) {
        if ($id) {
            
			$scope.users.splice($index, 1);
		
            return $http({
                method: 'DELETE',
                headers: {
                    "authorization": "Bearer " + $window.localStorage.getItem('token'),
                    "content-type": "application/json",
                    "accept": "application/json"
                },
                url: $rootScope.serviceBaseURL + 'user/delete',
                data: { "id":$id }
            }).success(function (data) {
                                               
                console.log(data);

            }).error(function (data, status) {
                $scope.msg = data;
				$scope.status = status;
            });
        }
    };
	
	$scope.getUserRecords = function (id) {
        if (id) {
           
            return $http({
				method: 'GET',
				headers: {
					"authorization": "Bearer " + $window.localStorage.getItem('token'),
					"content-type": "application/json",
					"accept": "application/json"
				},
				url: $rootScope.serviceBaseURL + 'record/user/'+id
			}).success(function (data, status) {
				
				if( errorMgs.indexOf(data['status']) !== -1 ){
					$rootScope.isAdmin = 0;
					$scope.msg = data['status'];
					$scope.status = status;
				}else{
					$rootScope.isAdmin = 1;
					recordService.setTemp(data['records']);
					//console.log(data['records']);
					$state.go("records");
				}
				
			}).error(function (data, status) {
				$scope.msg = data;
				$scope.status = status;
			});
        }
    };
	
});

