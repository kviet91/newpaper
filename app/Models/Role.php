<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = [
        'name', 
        'slug', 
        'permissions',
    ];

    protected $casts = [
        'permissions' => 'array',
    ];

    public function users()
    {
        return $this->belongsToMany('App\Models\User', 'role_user');
    }

    public function hasAccess(array $permissions):bool
    {

        foreach ($permissions as $permission)
        {
            if (!$this->hasPermission($permission))
            {
                return false;
            }
        }
        return true;
    }

    private function hasPermission(string $permission)
    {
        return $this->permissions[$permission] ?? false;
    }
}
