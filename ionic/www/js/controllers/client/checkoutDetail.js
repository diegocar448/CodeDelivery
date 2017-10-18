angular.module('starter.controllers')
	.controller('ClientCheckoutDetailCtrl', [
		'$scope', '$state', '$stateParams', '$cart', function($scope, $state, $stateParams, $cart){

			$scope.product = $cart.getItem($stateParams.index);		

			//alterar quantidade
			$scope.updateQtd = function()
			{
				$cart.updateQtd($stateParams.index, $scope.product.qtd); //indice+quantidade
				$state.go('client.checkout'); //redirecionar para client checkout
			}
	}]);