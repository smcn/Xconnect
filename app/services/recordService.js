// recordService.js

routerApp.factory('recordService', function(){
	var service = {
		setTemp:setTemp,
		getTemp:getTemp
	};
	var buffer;
	return service;
	
	function setTemp(temp){
		buffer = temp;
	}
	
	function getTemp(){
		return buffer;
	}
});
