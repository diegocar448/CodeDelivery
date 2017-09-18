<?php

namespace CodeDelivery\Http\Controllers;

use CodeDelivery\Http\Requests;
use CodeDelivery\Http\Requests\AdminCategoryRequest;
use CodeDelivery\Repositories\CategoryRepository;

//use Illuminate\Http\Request;


class CategoriesController extends Controller
{
	private $repository;

	public function __construct(CategoryRepository $repository)
	{
		$this->repository = $repository;
	}

    public function index()
    {    	

    	$categories = $this->repository->paginate();

    	return view('admin.categories.index', compact('categories'));
    }


    public function create()
    {
    	return view('admin.categories.create');
    }


    public function store(AdminCategoryRequest $request)
    {
    	//pega os todos os dados do formulario
    	$data = $request->all();
    	//vai criar o objeto e redirecionar depois
    	$this->repository->create($data);

    	return redirect()->route('admin.categories.index');
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
