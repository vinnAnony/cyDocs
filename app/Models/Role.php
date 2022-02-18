<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable =
        ['role_name','role_description'];

    public function users()
    {
        return $this->hasMany(User::class)->latest();
    }

    public function documents()
    {
        return $this->hasMany(Document::class)->latest();
    }

//    public function access_permissions()
//    {
//        return $this->hasMany(Document::class)->latest();
//    }
}
