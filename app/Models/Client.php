<?php

namespace CodeDelivery\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Client extends Model implements Transformable
{
    use TransformableTrait;

    protected $fillable = [
        'user_id',
        'phone',
        'address',
        'city',
        'state',
        'zipcode'
    ];


    public function user()
    {
        //relacionamento de 1 apenas 
        //que é para relacionar com id da tabela client e user_id q e a foreignkey        
        return $this->hasOne(User::class, 'id', 'user_id');
    }

}
