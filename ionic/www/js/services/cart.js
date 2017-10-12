angular.module('starter.services')
	.service('$cart',['$localStorage', function($localStorage){
		
		var key = 'cart';

		//limpar carrinho
		this.clear = function()
		{
			$localStorage.setObject(key, { //passando objeto com itens
				items: [],
				total: 0
			});
		};

		//trazer os objetos do nosso carrinho
		this.get = function()
		{
			return $localStorage.getObject(key);
		};

		//pegar um item de itens então é 1 item getItem de get
		this.getItem = function(i)
		{
			retun this.get().items[i];
		};

		this.addItem = function(item)
		{

		}
		this.removeItem = function(i)
		{

		}		
	}]);