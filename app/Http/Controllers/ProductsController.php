<?php

namespace CodeDelivery\Http\Controllers;

use CodeDelivery\Http\Requests;
use CodeDelivery\Http\Requests\AdminCategoryRequest;
use CodeDelivery\Http\Requests\AdminProductRequest;
use CodeDelivery\Repositories\CategoryRepository;
use CodeDelivery\Repositories\ProductRepository;

//use Illuminate\Http\Request;


class ProductsController extends Controller
{
    private $repository;

    private $categoryRepository;

    public function __construct(ProductRepository $repository, CategoryRepository $categoryRepository)
    {
        $this->repository = $repository;
        $this->categoryRepository = $categoryRepository;
    }

    public function index()
    {       

        $products = $this->repository->paginate();

        return view('admin.products.index', compact('products'));
    }


    public function create()
    {
        //trazer o name e o id para ser preenchida
        $categories = $this->categoryRepository->lists('name','id');
        return view('admin.products.create', compact('categories'));
    }



    public function store(AdminProductRequest $request)
    {
        //pega os todos os dados do formulario
        $data = $request->all();
        //vai criar o objeto e redirecionar depois
        $this->repository->create($data);

        return redirect()->route('admin.products.index');
    }



    public function edit($id)
    {
        //passar o repositorio com id
        $product = $this->repository->find($id);
                //trazer o name e o id para ser preenchida
        $categories = $this->categoryRepository->lists('name','id');

        return view('admin.products.edit', compact('product','categories'));
    }

    public function update(AdminProductRequest $request, $id)
    {
        //pega os todos os dados do formulario
        $data = $request->all();
        //vai criar o objeto, passa o id e redirecionar depois
        $this->repository->update($data, $id);

        return redirect()->route('admin.products.index');
    }

    public function destroy($id)
    {
        $this->repository->delete($id);

        return redirect()->route('admin.products.index');
    }


}
