angular.module('starter.services')
	.service('$cart', ['$localStorage', function($localStorage){
		
		var key = 'cart', cartAux = $localStorage.getObject(key);


		//se não existe realmente o nosso cart faça o clear para evitar erros
		if(!cartAux)
		{
			initCart();
		}


		//limpar carrinho
		this.clear = function()
		{
			initCart();
		};

		//trazer os objetos do nosso carrinho
		this.get = function()
		{
			return $localStorage.getObject(key);
		};

		//pegar um item de itens então é 1 item getItem de get
		this.getItem = function(i)
		{
			return this.get().items[i];
		};

		this.addItem = function(item)
		{
			//vai receber o nosso carrinho, get para chamar o localStorage getObject na variavel key
			var cart = this.get(), itemAux, exists = false;
			//Estrutura para ver se a gente ja criou um item
			for(var index in cart.items)
			{
				itemAux = cart.items[index];
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
			if(!exists)
			{
				item.subtotal = calculateSubTotal(item);//se o item não existe ja fez o calculo subtotal
				cart.items.push(item); //adicionei na coleção de itens
			}
			cart.total = getTotal(cart.items);
			//adicionar o cart no localStorage
			$localStorage.setObject(key, cart);
		};


		this.removeItem = function(i)
		{
			var cart = this.get();
			//splice=remover itens da nossa coleção de dados
			cart.items.splice(i,1); //i onde começa a remove e quantos itens eu quero remover 
			cart.total = getTotal(cart.items);
			$localStorage.setObject(key, cart); //ele sobrescreve o cart
		};		

		function calculateSubTotal(item)
		{
			return item.price * item.qtd;
		};

		//varrer todas as posições de item e somar o total de cada item
		function getTotal(items) 
		{
			var sum = 0;
			angular.forEach(items, function(item){
				sum += item.subtotal;
			});
			return sum;
		};

		this.updateQtd = function(i, qtd) //o indice q quer alterar e a qtd q queremos alterar
		{
			var cart = this.get(),
			itemAux = cart.item[i]; //item na posição "i"
			itemAux.qtd = qtd; //alterar qtd
			itemAux.subtotal = calculateSubTotal(itemAux); //cal subtotal
			cart.total = getTotal(cart.items); // calc o total do carrinho
			$localStorage.setobject(key, cart); //fazer a atualização
		};


		function initCart()
		{
			$localStorage.setObject(key, { //passando objeto com itens
				items: [],
				total: 0
			});
		};


	}]);