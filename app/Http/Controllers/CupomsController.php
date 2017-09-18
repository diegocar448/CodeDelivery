<?php

namespace CodeDelivery\Http\Controllers;

use CodeDelivery\Http\Requests;
use CodeDelivery\Http\Requests\AdminCupomRequest;
use CodeDelivery\Repositories\CupomRepository;

//use Illuminate\Http\Request;


class CupomsController extends Controller
{
	private $repository;

	public function __construct(CupomRepository $repository)
	{
		$this->repository = $repository;
	}

    public function index()
    {    	

    	$cupoms = $this->repository->paginate();

    	return view('admin.cupoms.index', compact('cupoms'));
    }


    public function create()
    {
    	return view('admin.cupoms.create');
    }


    public function store(AdminCupomRequest $request)
    {
    	//pega os todos os dados do formulario
    	$data = $request->all();
    	//vai criar o objeto e redirecionar depois
    	$this->repository->create($data);

    	return redirect()->route('admin.cupoms.index');
    }

    public function edit($id)
    {
    	//passar o repositorio com id
    	$category = $this->repository->find($id);

    	return view('admin.categories.edit', compact('category'));
    }

    public function update(AdminCategoryRequest $request, $id)
    {
    	//pega os todos os dados do formulario
    	$data = $request->all();
    	//vai criar o objeto, passa o id e redirecionar depois
    	$this->repository->update($data, $id);

    	return redirect()->route('admin.categories.index');
    }


}
