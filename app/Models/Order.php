<?php

namespace CodeDelivery\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Order extends Model implements Transformable
{
    use TransformableTrait;

    protected $fillable = [
		'client_id',
		'user_deliveryman_id',
		'total',
		'status'
		   
	];

	public function client()
	{
		//que a order pertence a um cliente meu
		return $this->belongsTo(Client::class);
	}

	public function items()
	{
		//Pegar os items de um pedido
		return $this->hasMany(OrderItem::class);
	}

	public function deliveryman()
	{
		//Pegar quem é o entregador do pedido // o 'user_deliverman_id' vai relacionar com id da tabela user
		return $this->belongsTo(User::class, 'user_deliveryman_id', 'id');
	}

	public function products()
	{
		//Pegar quem é o entregador do pedido
		return $this->hasMany(Product::class);
	}

}
