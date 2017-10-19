angular.module('starter.controllers')
	.controller('ClientCheckoutCtrl', [
		'$scope', '$state', '$cart', 'Order', '$ionicLoading', '$ionicPopup', 
		function($scope, $state, $cart, Order, $ionicLoading, $ionicPopup){
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


			$scope.openListProducts = function()
			{
				$state.go('client.view_products');
			}


			$scope.openProductDetail = function(i)
			{
				$state.go('client.checkout_item_detail', {index: i});
			};


			$scope.save = function()
			{
				//metodo do angularjs para cria copia do objeto para manipular 
				var items = angular.copy($scope.items); 
				angular.forEach(items, function(item){
					item.product_id = item.id; //para ter o product_id para enviar para a nossa Api
				});
				//antes de salvar mostrar o carregando
				$ionicLoading.show({
					template: 'Carregando....'
				});
				//agora vamos salvar
				Order.save({id: null}, {items: items}, function(data){ //função para o sucesso
					$ionicLoading.hide();
					$state.go('client.checkout_successful');
				}, function(responseError){ //função para o fracasso
					$ionicLoading.hide();
					$ionicPopup.alert({
						title: 'Advertência',
						template: 'Pedido não realizado - Tente novamente'
					})
				});
			};
	}]);