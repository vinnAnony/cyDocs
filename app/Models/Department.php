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
        return $this->belongsToMany(Document::class, 'department_documents',
            'department_id', 'document_id');
    }
}
