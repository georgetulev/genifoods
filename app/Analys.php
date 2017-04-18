<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Analys extends Model
{
    protected $table = 'analysis';

    protected $dates = ['created_at', 'updated_at', 'birthdate'];

    protected $fillable = [
        'customer_name',
        'birthdate',
        'result',
        'comments',
        'identity_number',
        'executed_by',
        'requested_by',
        'supervised_by',
        'reason',
    ];

    public function types(){
        return $this->belongsToMany(Type::class);
    }

    public function toArray($options = 0)
    {
        $data = [
            'customer_name' => $this->customer_name,
            'birthdate' => $this->birthdate->format('d.m.Y'),
            'recommendations'  => unserialize($this->result),
            'comments' => unserialize($this->comments),
            'identity_number' => $this->identity_number,
            'executed_by' => $this->executed_by,
            'requested_by' => $this->requested_by,
            'supervised_by'  => $this->supervised_by,
            'reason' => $this->reason,
            'created_at' => $this->created_at->format('d.m.Y')
        ];

        $data['types'] = [];
        $data['legend'] = [];
        foreach($this->types as $type) {
            $data['types'][] =  $type->getResultDescription();
        }
        $data['legend'] = $type->getLegend();

        return $data;
    }
}
