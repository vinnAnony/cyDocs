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
            'department_id',
            'document_file_path',
        ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function department()
    {
        return $this->belongsToMany(Department::class, 'department_documents',
            'document_id', 'department_id');
    }
}
