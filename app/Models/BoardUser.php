<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BoardUser extends Model
{
    use HasFactory;

    protected $table = 'board_user';
    protected $primaryKey = 'id';

    public function user(){
        return $this->belongsTo('App\Models\User');
    }
    public function board(){
        return $this->belongsTo('App\Models\Board');
    }
    public function tasks(){
        return $this->hasManyThrough('App\Models\Task', 'App\Models\Board', 'id', 'board_id', 'board_id' );
    }
}
