<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attachment extends Model
{
    use HasFactory;

    protected $table = 'attachments';
    protected $primaryKey = 'attachments_id';

    public function task(){

        return $this->belongsTo('App\Models\Task');
    }

    public function user(){

        return $this->hasOne('App\Models\User');
    }

}
