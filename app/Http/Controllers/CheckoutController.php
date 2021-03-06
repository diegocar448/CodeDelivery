<?php

namespace CodeDelivery\Http\Controllers;

use CodeDelivery\Http\Requests;
use CodeDelivery\Repositories\CategoryRepository;
use CodeDelivery\Repositories\OrderRepository;
use CodeDelivery\Repositories\ProductRepository;
use CodeDelivery\Repositories\UserRepository;
use CodeDelivery\Services\OrderService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    private $repository;
    private $userRepository;
    private $productRepository;
	private $service;

	public function __construct(
            OrderRepository $repository,
            UserRepository $userRepository, //pq vamos precisar pegar informações do usuario
            ProductRepository $productRepository, //pq vamos ter acesso aos produtos
            OrderService $service
    )
	
    {
        $this->repository = $repository;
        $this->userRepository = $userRepository;
        $this->productRepository = $productRepository;
		$this->service = $service;
	}

    public function index()
    {
        $clientId = $this->userRepository->find(Auth::user()->id)->client->id;
        //pegar as orders desse cliente especifico
        $orders = $this->repository->scopeQuery(function($query) use ($clientId) {
            return $query->where('client_id', '=', $clientId);
        })->paginate();

        return view('customer.order.index', compact('orders'));
    }


    public function create()
    {
        //$products = $this->productRepository->lists();

        //$products = $this->productRepository->lists('product','name','id');

        $products = $this->productRepository->lists( ['price', 'name', 'id'] );        

        return view('customer.order.create', compact('products'));
    }


    public function store(Requests\CheckoutRequest $request)
    {
        $data = $request->all();
        $clientId = $this->userRepository->find(Auth::user()->id)->client->id; //para identificar de quem e essa order
        $data['client_id'] = $clientId;
        $this->service->create($data);

        return redirect()->route('customer.order.index');
    }
}