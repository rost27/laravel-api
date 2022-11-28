<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    protected $fillable = [
        'candidate_id',
        'comment',
        'status',
    ];

    public function status(){
        return $this->belongsTo(Status::class);
    }
}