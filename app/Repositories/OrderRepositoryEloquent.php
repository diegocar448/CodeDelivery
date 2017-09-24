<?php

namespace CodeDelivery\Repositories;

use Illuminate\Database\Eloquent\Collection;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use CodeDelivery\Models\Order;


/**
 * Class OrderRepositoryEloquent
 * @package namespace CodeDelivery\Repositories;
 */
class OrderRepositoryEloquent extends BaseRepository implements OrderRepository
{

    public function getByIdAndDeliveryman($id, $idDeliveryman)
    {
        $result = $this->with(['client', 'items', 'cupom'])->findWhere([
            'id' => $id, 
            'user_deliveryman_id' => $idDeliveryman
        ]);

        
        $result = $result->first(); //pegamos a primeira posição
        if($result)
        {
            $result->items->each(function($item){ //para cada item a gente recupera o nosso produto
                $items->product;
            });
        }        

        return $result;
    }
    
    public function model()
    {
        return Order::class;
    }
   

   
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }


    public function presenter()
    {
        return Prettus\Repository\Presenter\ModelFractalPresenter::class;
    }

    public function presenter()
    {
        return \CodeDelivery\Presenters\OrderPresenter::class;
    }

}
