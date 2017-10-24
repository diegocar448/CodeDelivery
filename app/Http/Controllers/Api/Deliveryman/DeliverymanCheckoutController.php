<?php

namespace CodeDelivery\Http\Controllers\Api\Deliveryman;

use CodeDelivery\Http\Controllers\Controller;
//use Illuminate\Support\Facades\Auth;
use CodeDelivery\Http\Requests;
use CodeDelivery\Repositories\OrderRepository;
use CodeDelivery\Repositories\UserRepository;
use CodeDelivery\Services\OrderService;
use Illuminate\Http\Request;
use LucaDegasperi\OAuth2Server\Facades\Authorizer;

class DeliverymanCheckoutController extends Controller
{
    private $repository;
    private $userRepository;    
	private $service;

    //explicitar o presenter na controller //nos metodos abaixo tbm
    private $with = ['client', 'cupom', 'items'];

	public function __construct(
            OrderRepository $repository,
            UserRepository $userRepository, //pq vamos precisar pegar informações do usuario            
            OrderService $service
    )
	
    {
        $this->repository = $repository;
        $this->userRepository = $userRepository;       
		$this->service = $service;
	}

    public function index()
    {
        $id = Authorizer::getResourceOwnerId(); //pegamos o id        
        //pegar as orders desse cliente especifico
        $orders = $this->repository
                        ->skipPresenter(false)
                        ->with($this->with)
                        ->scopeQuery(function($query) use ($id) { 
            return $query->where('user_deliveryman_id', '=', $id);
        })->paginate();

        return $orders; //retornar os proprios dados em JSON
    }    
    

    //para gente conseguir pegar um registro apenas
    public function show($id)
    {
        $idDeliveryman = Authorizer::getResourceOwnerId(); //pegamos o id  do usuario
        return $this->repository
                    ->skipPresenter(false)
                    ->getByIdAndDeliveryman($id, $idDeliveryman);
                    //->getResourceOwnerId($id, $idDeliveryman);
    }

    public function updateStatus(Request $request, $id)
    {
        $idDeliveryman = Authorizer::getResourceOwnerId(); //pegamos o id  do deliveryman
        $order = $this->service->updateStatus($id, $idDeliveryman, $request->get('status'));
        if($order)
        {
            return $this->repository->find($order->id);
        }
        abort(400,"Order não encontrado");        
    }
}