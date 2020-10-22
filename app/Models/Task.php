<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $table = 'tasks';
    protected $primaryKey = 'tasks_id';

    public function comments(){

        return $this->hasManyThrough('App\Models\Comment' , 'App\Models\User');
    }
    public function attachments(){

        return $this->hasManyThrough('App\Models\Attachment' , 'App\Models\User');
    }

}
