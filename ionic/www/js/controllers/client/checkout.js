angular.module('starter.controllers')
	.controller('ClientCheckoutCtrl', [
		'$scope', '$state', '$cart', function($scope, $state, $cart){
			var cart =  $cart.get();			
			//pegando o carrinho q ja está todo estruturado e chamando os items dele
			$scope.items = cart.items;
			$scope.total = cart.total;	
			//remover item 
			$scope.removeItem = function(i){
				$cart.removeItem(i);
				$scope.items.splice(i, 1);//para excluir na posição clicada
				$scope.total = $cart.get().total; //faz a contagem e lista na tela
			};
	}]);