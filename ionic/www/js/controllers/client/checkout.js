angular.module('starter.controllers')
	.controller('ClientCheckoutCtrl', [
		'$scope', '$state', 'cart', '$localStorage', function($scope, $state, cart, $localStorage){

		$scope.items = cart.items;
		console.log($localStorage.getObject('cart') == null); //pegar o $localStorage
	}]);