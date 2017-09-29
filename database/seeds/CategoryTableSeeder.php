<?php
use CodeDelivery\Models\Category;
use CodeDelivery\Models\Product;
use Illuminate\Database\Seeder;

class CategoryTableSeeder extends Seeder
{
    public function run()
    {	
    	//para cada Category criar x produtos
        factory(Category::class, 10)->create()->each(function($c) 
        {
        	for ($i=0; $i<=5 ; $i++) { 

        		//buscar os produtos dessa categoria e salvar 5x
        		$c->products()->save(factory(Product::class)->make());
        	}
        });
    }
}
