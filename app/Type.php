<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    public $timestamps = false;

    protected $table = 'types';
    protected static $typesList = [
        'homo' => 'хомозиготен носител',
        'hetero' => 'хетерозиготен носител',
        'wildtype' => 'нормален хомозиготен носител (див тип)'
    ];
    protected static $legend = ['homo' => '+/+', 'hetero' => '+/-', 'wildtype' => '-/-'];

    protected $fillable = [
        'type',
        'genotype',
        'variant_id',
        'comment'
    ];

    public static function listOfTypes(){
        return static::$typesList;
    }

    public function typesList(){
        $variantId = $this->variant()->id;
        $typesList = Type::where('variant_id', $variantId)->lists('type','genotype');

        return $typesList;
    }

    public function analysis(){
        return $this->belongsToMany(Analys::class);
    }

    public function recommendations(){
        return $this->belongsToMany(Recommendation::class);
    }

    public function variant(){
        return $this->belongsTo(Variant::class);
    }

    // GroupName GeneName Genotype
    public function getDescription(){
        $variant = $this->variant;
        $gene = $variant->gene;
        $group = $gene->group;
        $type = isset( static::$typesList[$this->type]) ?  static::$typesList[$this->type] : '';

        return implode(' ', [$group->name, $gene->name, $type, $this->genotype]);
    }

    public function getResultDescription()
    {
        $variant = $this->variant;
        $gene = $variant->gene;
        $group = $gene->group;

        return [
            $gene->name,
            $group->name,
            $variant->norm,
            $this->genotype,
            static::$legend[$this->type]
        ];
    }

    public function gene()
    {
        return $this->HasManyThrough(Gene::class,Variant::class);
    }

    public function getLegend()
    {
        $legend = [];
        foreach(static::$typesList as $type => $name) {
            $legend[] = static::$legend[$type] . ': ' . $name;
        }
        return $legend;
    }
}
