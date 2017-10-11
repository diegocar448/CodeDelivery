angular.module('starter.controllers')
	.controller('ClientCheckoutCtrl', [
		'$scope', '$state', 'cart', '$localStorage', function($scope, $state, cart, $localStorage){

		$scope.items = cart.items;
		console.log($localStorage.get('cart')); //pegar o $localStorage
	}]);