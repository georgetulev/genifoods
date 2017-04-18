<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Variant extends Model
{
    public $timestamps = false;

    protected $table = 'variants';

    protected $fillable = [
        'norm',
        'change',
        'gene_id'
    ];

    public function types(){
        return $this->hasMany(Type::class);
    }

    public function gene(){
        return $this->belongsTo(Gene::class);
    }

    public function group(){
        return $this->HasManyThrough(Group::class,Gene::class);
    }
}
