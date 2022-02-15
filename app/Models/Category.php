<?php

namespace Models\App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use SoftDeletes;

    public function documents()
    {
        return $this->hasMany(Document::class)->latest();
    }
}
