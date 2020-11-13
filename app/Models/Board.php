<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Board extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';


    public function tasks(){
        return $this->hasMany('App\Models\Task');
    }
    public function users(){
        return $this->belongsToMany('App\Models\User')
                    ->using('App\Models\BoardUser')
                    ->withTimestamps()
                    ->withPivot('board_id', 'user_id');
    }
    public function owner(){
        return $this->belongsTo(User::class, 'user_id');
}

}
