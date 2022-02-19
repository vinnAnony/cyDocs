<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FileRequest extends Model
{
    use SoftDeletes;

    protected $fillable =
        [
            'document_id',
            'department_id',
            'category_id',
            'requester_id',
            'requester_message',
        ];

    public function requester()
    {
        return $this->belongsTo(User::class, 'requester_id');
    }

    public function approver()
    {
        return $this->belongsTo(User::class, 'approver_id');
    }

    public function document()
    {
        return $this->belongsTo(Document::class, 'document_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id');
    }
}
