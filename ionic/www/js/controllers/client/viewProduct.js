angular.module('starter.controllers')
	.controller('ClientViewProductCtrl', [
		'$scope', '$state', 'Product', '$ionicLoading', function($scope, $state, Product, $ionicLoading){

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
	}]);


