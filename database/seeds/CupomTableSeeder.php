<?php
use CodeDelivery\Models\Cupom;
use CodeDelivery\Models\Product;
use Illuminate\Database\Seeder;

class CupomTableSeeder extends Seeder
{
    public function run()
    {	
        //criar 10 cupons
    	factory(Cupom::class, 10)->create();
    }
}
