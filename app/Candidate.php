<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Candidate extends Model
{
    protected $fillable = [
        'first_name',
        'last_name',
        'status',
        'position',
        'salary_range',
        'linkedin_url',
        'cv_file'
    ];

    public function statuses(){
        return $this->hasMany(Status::class);
    }

    public function skills(){
        return $this->hasMany(Skill::class);
    }
}