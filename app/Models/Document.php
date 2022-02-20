<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Document extends Model
{
    use SoftDeletes;

    protected $fillable =
        [
            'document_title',
            'category_id',
            'role_id',
            'created_by',
            'deleted_by',
            'department_id',
            'document_file_path',
        ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id');
    }

    public function accessRole()
    {
        return $this->belongsTo(Role::class, 'role_id');
    }
}
