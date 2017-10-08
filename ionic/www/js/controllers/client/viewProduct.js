angular.module('starter.controllers')
	.controller('ClientViewProductCtrl', [
		'$scope', '$state', 'appConfig', '$resource', function($scope, $state, appConfig, $resource){

		var product = $resource(appConfig.baseUrl + '/api/client/products', {}, {

			query:{
				isArray: false
			}
		});

		product.query({}, function(data){
			console.log("Mostrando produtos");
			console.log(data);
		});

	}]);