<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryToolKey extends Model
{
    use HasFactory;
    protected $fillable = [
        'category_id',
        'tool_name_id'
    ];
}
