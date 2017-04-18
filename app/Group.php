<?php

namespace App;

use Session;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    protected $table = 'groups';

    protected $fillable = [
        'name',
        'function'
    ];

    public $timestamps = false;

    public function genes(){
        return $this->hasMany(Gene::class);
    }

    public function variants(){
        return $this->HasManyThrough(Variant::class ,Gene::class);
    }
}
