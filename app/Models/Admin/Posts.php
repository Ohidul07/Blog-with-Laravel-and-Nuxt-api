<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Posts extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'posts';
    protected $fillable = [
        'title',
        'description',
        'writer',
        'image',
        'category_id',
        'tag_id',
        'status',
        'created_by',
        'updated_by'
    ];
}
