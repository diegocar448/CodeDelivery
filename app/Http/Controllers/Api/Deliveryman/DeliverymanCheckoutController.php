<?php

namespace CodeDelivery\Http\Controllers\Api\Deliveryman;

use CodeDelivery\Http\Controllers\Controller;
use CodeDelivery\Http\Requests;
use CodeDelivery\Repositories\OrderRepository;
use CodeDelivery\Services\OrderService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use LucaDegasperi\OAuth2Server\Facades\Authorizer;

class DeliverymanCheckoutController extends Controller
{
    private $repository;
    private $userRepository;    
	private $service;

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
        $orders = $this->repository->with('items')->scopeQuery(function($query) use ($id) { 
            return $query->where('user_deliveryman_id', '=', $id);
        })->paginate();

        return $orders; //retornar os proprios dados em JSON
    }    
    

    //para gente conseguir pegar um registro apenas
    public function show($id)
    {
        $o = $this->repository->with(['client', 'items', 'cupom'])->find($id);
        $o->items->each(function($item){
            $items->product;
        });

        return $o;
    }
}