<?php

namespace CodeDelivery\Http\Controllers\Api\Client;

use CodeDelivery\Http\Controllers\Controller;
use CodeDelivery\Http\Requests;
use CodeDelivery\Repositories\OrderRepository;
use CodeDelivery\Repositories\UserRepository;
use CodeDelivery\Services\OrderService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use LucaDegasperi\OAuth2Server\Facades\Authorizer;

class ClientCheckoutController extends Controller
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
        $clientId = $this->userRepository->find($id)->client->id; //passamos o client e o id do client
        //pegar as orders desse cliente especifico
        $orders = $this->repository->with('items')->scopeQuery(function($query) use ($clientId) { //acresentar a relação items em nossa consulta
            return $query->where('client_id', '=', $clientId);
        })->paginate();

        return $orders; //retornar os proprios dados em JSON
    }    


    public function store(Requests\AdminClientRequest $request)
    {        
        $data = $request->all();
        $id = Authorizer::getResourceOwnerId(); //pegamos o id
        $clientId = $this->userRepository->find($id)->client->id; 
        $data['client_id'] = $clientId;
        $o = $this->service->create($data);
        $o = $this->repository->with(['items'])->find($o->id); //serializar os itens para a gente

        return $o;
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