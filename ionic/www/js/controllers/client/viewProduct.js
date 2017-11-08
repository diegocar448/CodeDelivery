angular.module('starter.controllers')
	.controller('ClientViewProductCtrl', [
		'$scope', '$state', 'Product', '$ionicLoading', '$cart', 
		function($scope, $state, Product, $ionicLoading, $cart){	

			$scope.products = []; //vai iniciar vazio
			$ionicLoading.show({
				template: 'Carregando....'  /*aparece qdo inicia o carregamento*/
			});

			Product.query({}, function(data){	//função de sucesso		
				$scope.products = data.data; //pegar os dados que vem da Api
				$ionicLoading.hide(); //apresentar qdo for carregado com sucesso
			}, function(dataError){ //função de fracasso
				$ionicLoading.hide(); //apresentar qdo fracassar carregamento
			});

			//adiciona o cart a nosso carrinho
			$scope.addItem = function(item){
				item.qtd = 1;
				$cart.addItem(item);
				$state.go('client.checkout');
			}
	}]);


