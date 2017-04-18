<?php

namespace App;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    // user;
    // name = Joro; email = joro@example.com; pass = Joro;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function roles(){
        return $this->belongsToMany(Role::class);
    }

    public function hasRole($name){
        foreach ($this->roles as $role) {
            if ($role->name == $name) return true;
        }
        return false;
    }

    /**
     * ToDo
     */
    public function createUserIfAdmin(){

    }
}
