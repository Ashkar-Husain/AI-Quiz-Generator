<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    protected $fillable = [
        'branch_id',
        'topic_name',
        'subject',
        'difficulty_id',
        'icon',
        'topic_description',
        'created_by'
    ];
}
