<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gene extends Model
{
    protected $table = 'genes';

    protected $fillable = [
        'name',
        'group_id'
    ];

    public $timestamps = false;

    public function group()
    {
        return $this->belongsTo(Group::class);
    }

    public function variants()
    {
        return $this->hasMany(Variant::class);
    }

    public function getGroupName()
    {
       return $this->getGroup() ? $this->getGroup()->name : '';
    }

    public function getGroupFunction()
    {
        return $this->getGroup() ? $this->getGroup()->function : '';
    }

    public function getGroup()
    {
        $groups = $this->group()->get();
        if (!count($groups)) {
            return null;
        }
        return $groups[0];
    }

// Additional relationship 'HasManyThrough' is added instead

    public function getType($type = null)
    {
        $variant = $this->getVariant();
        if(!$variant) {
            return null;
        }

        $types = $variant->types()->where('type', $type)->get();
        if (!count($types)) {
            return null;
        }
        return $types[0];
    }

    /**
     * @return Variant
     */
    public function getVariant()
    {
        $variants = $this->variants()->get();
        if (!count($variants)) {
            return null;
        }
        return $variants[0];
    }

    public function scopeSearch($query, $search){
        return $query->where('name', 'LIKE', "%$search%");
    }

    public function types(){
        return $this->HasManyThrough(Type::class, Variant::class);
    }
}
