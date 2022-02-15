<?php

namespace Models\App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Document extends Model
{
    use SoftDeletes;

    public function category()
    {
        return $this->belongsTo('App\Models\Category', 'category_id');
    }

//    public function department()
//    {
//        return $this->belongsTo('App\Models\Department', 'department_id');
//    }
}
