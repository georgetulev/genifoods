<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Recommendation extends Model
{
    protected $table = 'recommendations';

    public $timestamps = false;

    protected $fillable = [
        'description',
    ];

    public function types(){
        return $this->belongsToMany(Type::class);
    }

    public function listOfVariants(){
       // $this->types()
    }

    public function recommendationTypeGenotypeList($id){
        $r = $this->findOrFail($id);

        $list =  $r->types()->lists('type','genotype' )->all();

        return $list;
    }

    public function getRecAssosiations(Type $type){
        $type->variant()->lists('norm','change');
    }

}
