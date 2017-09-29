<?php

namespace CodeDelivery\Http\Controllers;

use CodeDelivery\Repositories\OrderRepository;
use CodeDelivery\Repositories\UserRepository;
use CodeDelivery\Http\Requests;

use Illuminate\Http\Request;


class OrdersController extends Controller
{

	private $repository;

	public function __construct(OrderRepository $repository)
	{
		$this->repository = $repository;
	}

	public function index()
	{
		$orders = $this->repository->paginate();

		return view('admin.orders.index', compact('orders'));
	}

	public function edit($id, UserRepository $userRepository)
	{
		//listar o status
		$list_status = [0=>'Pendente', 1=>'A caminho', 2=>'Entregue', 3=>'Cancelado'];

		//pegar o id
		$order = $this->repository->find($id);

		//pegar o deliveryman role=>deliveryman mas pegar somente o nome e o id do json ['name, id'] em model Order no metodo getDeliverymen
		$deliveryman = $userRepository->getDeliverymen();

		return view('admin.orders.edit', compact('order', 'list_status', 'deliveryman'));
	}


	public function update(Request $request, $id)
	{
		//pega todos as informações da request
		$all = $request->all();

		//pega tudo com o id e faz as alterações
		$this->repository->update($all, $id);

		return redirect()->route('admin.orders.index');
	}

}