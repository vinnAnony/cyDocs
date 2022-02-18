<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Department extends Model
{

    protected $fillable =
    [
        'department_name'
    ];

    public function categories()
    {
        return $this->hasMany(Category::class)->latest();
    }
}
