<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryToolNameKey extends Model
{
    use HasFactory;
    protected $table = 'category_tool_names';
    protected $fillable = [
        'category_id',
        'tool_name_id'
    ];
}
