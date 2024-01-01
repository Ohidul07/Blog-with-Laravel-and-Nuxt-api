<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Admin\Posts;
use App\Http\Requests\StorePostsRequest;
use App\Http\Requests\UpdatePostsRequest;
use App\Interfaces\PostRepositoryInterface;
use App\Models\Admin\Categories;
use App\Http\Requests\StoreCategoriesRequest;
use App\Http\Requests\UpdateCategoriesRequest;
use App\Interfaces\CategoryRepositoryInterface;
use DB;

class PostsController extends Controller
{

    private $category;

    public function __construct(CategoryRepositoryInterface $categoryRepository)
    {
        $this->category = $categoryRepository;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->category->getAllCategories();   
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoriesRequest $request)
    {
        return $this->category->createCategory($request->all());    
    }

    /**
     * Display the specified resource.
     */
    public function show(Categories $categories)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Categories $categories, $id)
    {
        return $this->category->editCategory($id);     
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoriesRequest $request, $id)
    {
        return $this->category->updateCategory($request->all(), $id); 
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        return $this->category->deleteCategory($id); 
    }
}
