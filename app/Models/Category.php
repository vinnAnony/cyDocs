<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{

    protected $fillable =
        [
            'category_name'
        ];

    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id');
    }

    public function documents()
    {
        return $this->hasMany(Document::class)->latest();
    }
}
