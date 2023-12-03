<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Borrower extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'borrowers';
    protected $primaryKey = 'id';
    protected $fillable = [
        'image',
        'studnum',
        'firstname',
        'midname',
        'lastname',
        'contact',
        'sex',
        'year',
        'section',
        'reported_at',
    ];

    public function borrowercourse()
    {
        return $this->belongsToMany(Course::class, 'borrower_course');
    }

    public function borrowercollege()
    {
        return $this->belongsToMany(College::class, 'borrower_college');
    }

    public function toolreport()
    {
        return $this->belongsToMany(Borrower::class, 'tool_report');
    }
}
