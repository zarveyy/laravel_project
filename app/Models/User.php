<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class User extends Model
{
    use HasFactory, Notifiable;

    public function attachments(){
        return $this->hasManyThrough('App\Models\Attachment' , 'App\Models\Task');
    }
    public function comments(){
        return $this->hasManyThrough('App\Models\Comment' , 'App\Models\Task');
    }
    public function boards() {
        return $this->belongsToMany('App\Models\Board', 'board_user', 'board_id', 'user_id');

    }

}
