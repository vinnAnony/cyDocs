<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Document extends Model
{
    use SoftDeletes;

    protected $fillable =
        [
            'document_title',
            'category_id',
            'department_id'
        ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function departments()
    {
        return $this->belongsToMany(Department::class, 'department_documents',
            'document_id', 'department_id');
    }
}
