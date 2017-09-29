<?php

namespace CodeDelivery\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class OrderItem extends Model implements Transformable
{
    use TransformableTrait;

    protected $fillable = [
		'product_id',
		'order_id',
		'price',
		'qtd',		   
	];
	
	public function order()
	{
		//Pegar a Order que esta relacionada com o meu pedido tbm
		return $this->belongsTo(Order::class);
	}
	
	public function product()
	{
		//qual produto que esta relacionado com esse item
		return $this->belongsTo(Product::class);
	}

}
