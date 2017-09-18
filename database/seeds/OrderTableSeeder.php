<?php
use CodeDelivery\Models\Order;
use CodeDelivery\Models\OrderItem;
use Illuminate\Database\Seeder;

class OrderTableSeeder extends Seeder
{
    public function run()
    {	
    	//para cada Order
        factory(Order::class, 10)->create()->each(function($o) 
        {
            //Em cada order criar 2 itens
        	for ($i=0; $i<=2 ; $i++) 
            { 
        		//criando 1 item
        		$o->items()->save(factory(OrderItem::class)->make([
                    //Escolher quais os itens ele vai inserir
                    'product_id' =>rand(1,5),
                    'qtd' =>2,
                    'price' =>50
                ]));
        	}
        });
    }
}
