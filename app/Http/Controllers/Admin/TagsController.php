<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Admin\Tags;
use App\Http\Requests\StoreTagsRequest;
use App\Http\Requests\UpdateTagsRequest;
use App\Interfaces\TagRepositoryInterface;
use DB;

class TagsController extends Controller
{

    private $tag;

    public function __construct(TagRepositoryInterface $tagRepository)
    {
        $this->tag = $tagRepository;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->tag->getAllTags();   
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
    public function store(StoreTagsRequest $request)
    {
        return $this->tag->createtag($request->all());    
    }

    /**
     * Display the specified resource.
     */
    public function show(Tags $Tags)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tags $Tags, $id)
    {
        return $this->tag->editTag($id);     
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTagsRequest $request, $id)
    {
        return $this->tag->updateTag($request->all(), $id); 
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        return $this->tag->deleteTag($id); 
    }
}
