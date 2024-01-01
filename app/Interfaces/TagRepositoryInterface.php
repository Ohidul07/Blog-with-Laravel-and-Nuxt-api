<?php 

namespace App\Interfaces;

interface TagRepositoryInterface 
{
	public function getAllTags();
	public function createTag(array $tagDetails);
	public function editTag($id);
	public function updateTag(array $tagDetails, $id);
	public function deleteTag($id);
}