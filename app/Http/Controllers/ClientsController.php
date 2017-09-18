<?php

namespace CodeDelivery\Http\Controllers;

use CodeDelivery\Http\Requests;
use CodeDelivery\Http\Requests\AdminClientRequest;
use CodeDelivery\Repositories\ClientRepository;
use CodeDelivery\Services\ClientService;

//use Illuminate\Http\Request;


class ClientsController extends Controller
{
    /*
      var ClientRepository  
    */
	private $repository;

    private $clientService;

	public function __construct(ClientRepository $repository, ClientService $clientService)
	{
        $this->repository = $repository;
		$this->clientService = $clientService;
	}

    public function index()
    {    	

    	$clients = $this->repository->paginate();

        return view('admin.clients.index', compact('clients'));
    	//return view('admin.clients.index');
    }


    public function create()
    {
    	return view('admin.clients.create');
    }


    public function store(AdminClientRequest $request)
    {
    	//pega os todos os dados do formulario
    	$data = $request->all();
    	//vai criar o objeto e redirecionar depois
    	$this->clientService->create($data);

    	return redirect()->route('admin.clients.index');
    }

    public function edit($id)
    {
    	//passar o repositorio com id
    	$client = $this->repository->find($id);

    	return view('admin.clients.edit', compact('client'));
    }

    public function update(AdminClientRequest $request, $id)
    {
    	//pega os todos os dados do formulario
    	$data = $request->all();
    	//vai criar o objeto, passa o id e redirecionar depois
    	$this->clientService->update($data, $id);

    	return redirect()->route('admin.clients.index');
    }


}
