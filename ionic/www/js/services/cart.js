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
			//vai receber o nosso carrinho, get para chamar o localStorage getObject na variavel key
			var cart = this.get(), itemAux, exists = false;

			for(var index in cart.items)
			{
				itemsAux = cart.items[index];
				if (itemAux.id == item.id) //verificar se o item ja foi escolhido para impedir duplicação
				{
					//soma o itens q ja foram inseridos com os items que estão sendo inseridos
					itemAux.qtd = item.qtd + itemAux.qtd; 
					itemAux.subtotal = calculateSubTotal(itemAux);
					exists = true;
					break;
				}
			}
			//se ele não existe entra aqui, não tem produto que não esteja adicionado
			if(!exits)
			{
				item.subtotal = calculateSubTotal(item);//se o item não existe ja fez o calculo subtotal
				cart.items.push(item); //adicionei na coleção de itens
			}
			$localStorage.setObject(key, cart);
		}
		this.removeItem = function(i)
		{

		}		

		function calculateSubTotal(item)
		{
			return item.price * item.qtd;
		}
	}]);