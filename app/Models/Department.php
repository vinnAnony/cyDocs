<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Department extends Model
{
    use SoftDeletes;

    protected $fillable =
        [
            'department_name'
        ];

    public function documents()
    {
        return $this->hasMany(Category::class)->latest();
    }
}
