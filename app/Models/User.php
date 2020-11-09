<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class User extends Model
{
    use HasFactory, Notifiable;

    protected $primaryKey = 'id';

    public function attachments(){
        return $this->hasMany('App\Models\Attachment');
    }
    public function comments(){
        return $this->hasMany('App\Models\Comment');
    }
    public function boards() {
        return $this->belongsToMany('App\Models\Board');

    }

}
