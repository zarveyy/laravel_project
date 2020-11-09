<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $table = 'tasks';
    protected $primaryKey = 'id';


    public function comments(){

        return $this->hasMany('App\Models\Comment');
    }
    public function attachments(){

        return $this->hasMany('App\Models\Attachment');
    }
    public function category(){
        return $this->belongsTo('App\Models\Category');
    }
    public function board(){
        return $this->belongsTo('App\Models\Board');
    }

}
