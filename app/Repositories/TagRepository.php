<?php

namespace App\Repositories;
use App\Interfaces\TagRepositoryInterface;
use App\Models\Admin\Tags;
use App\Http\Resources\TagResource;
use DB;

/**
 * 
 */
class TagRepository implements TagRepositoryInterface
{
	private $tagModel;

	function __construct(Tags $tagModel)
	{
		$this->tagModel = $tagModel;
	}

	public function getAllTags()
	{
		$tags = DB::table('tags')
            ->whereNull('deleted_at')
            ->orderBy('id','desc')
            ->paginate(10);

        if ($tags->isNotEmpty()) {
            return TagResource::collection($tags);
        } else {
            return response(['data' => []]);
        } 
	}

	public function createTag(array $tagDetails)
	{
		$tagDetails['created_by'] = auth()->user()->id;
		$tag = $this->tagModel::create($tagDetails);
		return [
		    "message" => "Tag created successfully."
		]; 	
	}

	public function editTag($id)
	{
		$tag = $this->tagModel::find($id);
		return [
            "data" => new TagResource($tag)
        ];
	}

	public function updateTag(array $tagDetails, $id)
	{
		$tagDetails['updated_by'] = auth()->user()->id;
		$tagId = $this->tagModel::find($id);
    	$tagId->update($tagDetails);
		return [
		    "message" => "Tag updated successfully."
		]; 	
	}

	public function deleteTag($id)
	{
		$tagId = $this->tagModel::find($id);
		$tagId->updated_by = auth()->user()->id;
		$tagId->save();
    	$tagId ->delete();
    	return [
		    "message" => "Tag deleted successfully."
		]; 
	}
}
