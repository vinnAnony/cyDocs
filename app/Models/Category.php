<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use SoftDeletes;

    protected $fillable =
        [
            'category_name'
        ];

    public function documents()
    {
        return $this->hasMany(Document::class)->latest();
    }
}