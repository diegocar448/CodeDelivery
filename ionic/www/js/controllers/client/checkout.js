angular.module('starter.controllers')
	.controller('ClientCheckoutCtrl', [
		'$scope', '$state', 'cart', function($scope, $state, cart){

		$scope.items = cart.items;
		console.log(JSON.parse(window.localStorage['cart']));

	}]);