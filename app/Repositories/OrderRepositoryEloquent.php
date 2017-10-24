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
    protected $skipPresenter = true;

    public function getByIdAndDeliveryman($id, $idDeliveryman)
    {
        $result = $this->with(['client', 'items', 'cupom'])->findWhere([
            'id' => $id, 
            'user_deliveryman_id' => $idDeliveryman
        ]);
        //temos que fazer um first se o result for uma instancia do nosso collection
        if ($result instanceof Collection) {
            $result = $result->first();
        //se não for uma instancia do objeto será uma array
        } else{
             if (isset($result['data']) && count($result['data']) == 1) {
                $result = [
                    'data' => $result['data'][0]
                ];
            }else{
                throw new ModelNotFoundException("Order não existe");
            }
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
    
    /*
    public function presenter()
    {
        return \Prettus\Repository\Presenter\ModelFractalPresenter::class;
    }*/
    
    
    public function presenter()
    {
        return \CodeDelivery\Presenters\OrderPresenter::class;
    }
}