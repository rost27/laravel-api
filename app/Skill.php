<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    protected $fillable = [
        'candidate_id',
        'name'
    ];

    public function skill(){
        return $this->belongsTo(Skill::class);
    }
}