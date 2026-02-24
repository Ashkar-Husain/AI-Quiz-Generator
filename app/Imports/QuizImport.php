<?php

namespace App\Imports;

use App\Models\Quiz;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

use Maatwebsite\Excel\Concerns\WithValidation;

class QuizImport implements ToModel, WithHeadingRow, WithValidation
{
    public function model(array $row)
    {
        return new Quiz([
            'branch_id'       => auth()->user()->branch_id ?? 'Main Branch',
            'topic_id'        => $row['topic_id'],
            'question'        => $row['question'],
            'option_1'        => $row['option_1'],
            'option_2'        => $row['option_2'],
            'option_3'        => $row['option_3'] ?? null,
            'option_4'        => $row['option_4'] ?? null,
            'correct_option'  => $row['correct_option'],
            'difficulty'  => $row['difficulty'],
            'created_by'      => auth()->user()->user_id,
            'updated_by'      => Null,
        ]);
    }

    public function rules(): array
    {
        return [
            '*.topic_id' => 'required|exists:topic_names,id',
            '*.question' => 'required',
            '*.option_1' => 'required',
            '*.option_2' => 'required',
            '*.correct_option' => 'required',
        ];
    }
}
