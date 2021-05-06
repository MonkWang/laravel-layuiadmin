<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Permissions extends Authenticatable
{
    use HasFactory;
    protected $table = 'permissions';
    protected $dateFormat = 'U';

    public function child_hasMany()
    {
        return $this->hasMany(Permissions::class, 'pid', 'id')
            ->where('show', 1);
    }
}
