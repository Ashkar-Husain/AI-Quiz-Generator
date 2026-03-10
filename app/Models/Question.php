<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable = [
        'branch_id',
        'topic_id',
        'question',
        'created_at'
    ];
}
