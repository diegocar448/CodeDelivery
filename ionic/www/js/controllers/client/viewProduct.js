angular.module('starter.controllers')
	.controller('ClientViewProductCtrl', [
		'$scope', '$state', 'Product', function($scope, $state, Product){

		Product.query({}, function(data){
			console.log(data.data);
		});

	}]);


