<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class TaskUser extends Pivot
{
    use HasFactory;

    public $incrementing = true;

    public function user(){
        return $this->belongsTo('App\Models\User');
    }
    public function task(){
        return $this->belongsTo('App\Models\Task');
    }
}
