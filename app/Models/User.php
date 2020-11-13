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
    public function ownedBoards(){
        return $this->hasMany('App\Models\Board');
    }
    public function boards() {
        return $this->belongsToMany('App\Models\Board')
                    ->using('App\Models\BoardUser')
                    ->withTimestamps()
                    ->withPivot('id');
    }

    public function assignedTasks(){
        return $this->belongsToMany('App\Models\Task')
            ->using('App\Models\TaskUser')
            ->withTimestamps()
            ->withPivot('id');
    }
    public function allTasks(){
        return $this->hasManyThrough(
            Task::class,
            BoardUser::class,
            'board_id',
            'id',
            'board_id'
        );
    }
}
