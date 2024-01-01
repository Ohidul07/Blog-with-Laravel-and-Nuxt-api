<?php

namespace App\Repositories;
use App\Interfaces\CategoryRepositoryInterface;
use App\Models\Admin\Categories;
use App\Http\Resources\CategoryResource;
use DB;

/**
 * 
 */
class CategoryRepository implements CategoryRepositoryInterface
{
	private $categoryModel;

	function __construct(Categories $categoryModel)
	{
		$this->categoryModel = $categoryModel;
	}

	public function getAllCategories()
	{
		$categories = DB::table('categories')
            ->whereNull('deleted_at')
            ->orderBy('id','desc')
            ->paginate(10);

        if ($categories->isNotEmpty()) {
            return CategoryResource::collection($categories);
        } else {
            return response(['data' => []]);
        } 
	}

	public function createCategory(array $categoryDetails)
	{
		$categoryDetails['created_by'] = auth()->user()->id;
		$category = Categories::create($categoryDetails);
		return [
		    "message" => "Category created successfully."
		]; 	
	}

	public function editCategory($id)
	{
		$category = $this->categoryModel::find($id);
		return [
            "data" => new CategoryResource($category)
        ];
	}

	public function updateCategory(array $categoryDetails, $id)
	{
		$categoryDetails['updated_by'] = auth()->user()->id;
		$catId = $this->categoryModel::find($id);
    	$catId->update($categoryDetails);
		return [
		    "message" => "Category updated successfully."
		]; 	
	}

	public function deleteCategory($id)
	{
		$catId = $this->categoryModel::find($id);
		$catId->updated_by = auth()->user()->id;
		$catId->save();
    	$catId ->delete();
    	return [
		    "message" => "Category deleted successfully."
		]; 
	}
}
