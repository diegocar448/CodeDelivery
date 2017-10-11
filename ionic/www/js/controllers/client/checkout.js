angular.module('starter.controllers')
	.controller('ClientCheckoutCtrl', [
		'$scope', '$state', 'cart', function($scope, $state, cart){

		$scope.items = cart.items;
		
	}]);