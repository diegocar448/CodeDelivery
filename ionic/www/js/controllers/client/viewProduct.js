angular.module('starter.controllers')
	.controller('ClientViewProductCtrl', [
		'$scope', '$state', 'Product', '$ionicLoading', 'cart', function($scope, $state, Product, $ionicLoading, cart){

		window.localStorage['cart'] = JSON.stringify({
			name: "Ionic",
			version: "1.1.0"
		});

		$scope.products = [];		
		$ionicLoading.show({
			template: 'Carregando....'
		});

		Product.query({}, function(data){	//função de sucesso		
			$scope.products = data.data; //pegar os dados que vem da Api
			$ionicLoading.hide(); //apresentar qdo for carregado com sucesso
		}, function(dataError){ //função de fracasso
			$ionicLoading.hide(); //apresentar qdo fracassar carregamento
		});


		$scope.addItem = function(item){
			cart.items.push(item); //nos vamos colocar um objeto no final desse array adicionar um item
			$state.go('client.checkout'); //redirecionar para o checkout
		};
	}]);


