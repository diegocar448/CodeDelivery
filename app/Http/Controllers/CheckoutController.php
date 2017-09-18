<?php

namespace CodeDelivery\Http\Controllers;

use CodeDelivery\Http\Requests;
//use CodeDelivery\Http\Requests\AdminCategoryRequest;
use CodeDelivery\Repositories\OrderRepository;
use CodeDelivery\Repositories\UserRepository;
use CodeDelivery\Repositories\ProductRepository;

//use Illuminate\Http\Request;


class CheckoutController extends Controller
{
    private $repository;
    private $userRepository;
	private $productRepository;

	public function __construct(
            OrderRepository $repository,
            UserRepository $userRepository, //pq vamos precisar pegar informações do usuario
            ProductRepository $productRepository //pq vamos ter acesso aos produtos
    )
	
    {
        $this->repository = $repository;
        $this->userRepository = $userRepository;
		$this->productRepository = $productRepository;
	}


    public function create()
    {
        //$products = $this->productRepository->lists();

        //$products = $this->productRepository->lists('product','name','id');

        $products = $this->productRepository->lists( ['price', 'name', 'id'] );        

        return view('customer.order.create', compact('products'));
    }


    public function store()
    {
        
    }
}