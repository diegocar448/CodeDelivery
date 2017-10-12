angular.module('starter.controllers')
	.controller('ClientCheckoutCtrl', [
		'$scope', '$state', '$cart', function($scope, $state, $cart){
			var cart =  $cart.get();			
			//pegando o carrinho q ja está todo estruturado e chamando os items dele
			$scope.items = cart.items;
			$scope.total = cart.total;		
	}]);