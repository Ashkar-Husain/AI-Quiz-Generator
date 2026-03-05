<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    protected $fillable = [
        'branch_id',
        'topic_id',
        'question_id',
        'option_1',
        'option_2',
        'option_3',
        'option_4',
        'correct_option',
        'created_by',
        'updated_by',
    ];
}

