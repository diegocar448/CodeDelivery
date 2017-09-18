<?php
use CodeDelivery\Models\Client;
use CodeDelivery\Models\User;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{   
    public function run()
    {
    	//Aqui passaremos parametros especificos do usuario
    	factory(User::class)->create([
	        'name' => 'User',
	        'email' => 'user@user.com',
	        'password' => bcrypt(12345),
	        'remember_token' => str_random(10),
    	])->client()->save(factory(Client::class)->make());

    	factory(User::class)->create([
	        'name' => 'Admin',
	        'email' => 'admin@user.com',
	        'password' => bcrypt(123456),
	        'role' => 'admin',
	        'remember_token' => str_random(10),
    	])->client()->save(factory(Client::class)->make());

        //criar 10 clientes
        factory(User::class, 10)->create()->each(function($u) {
        	$u->client()->save(factory(\CodeDelivery\Models\Client::class)->make());
        });

        //criar 3 entregadores principais no sistema
        factory(User::class, 3)->create([
            'role' => 'deliveryman',            
        ]);
    }
}
