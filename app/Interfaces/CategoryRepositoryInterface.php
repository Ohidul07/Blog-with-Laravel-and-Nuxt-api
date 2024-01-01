<?php 

namespace App\Interfaces;

interface CategoryRepositoryInterface 
{
	public function getAllCategories();
	public function createCategory(array $categoryDetails);
	public function editCategory($id);
	public function updateCategory(array $categoryDetails, $id);
	public function deleteCategory($id);
}