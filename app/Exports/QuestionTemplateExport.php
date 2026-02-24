<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromArray;

class QuestionTemplateExport implements FromArray, WithHeadings
{
    public function headings(): array
    {
        return [
            'topic_id',
            'question',
            'option_1',
            'option_2',
            'option_3',
            'option_4',
            'correct_option',
            'difficulty'
        ];
    }

    public function array(): array
    {
        return [
            // [
            //     'Sample Question?',
            //     'Option A',
            //     'Option B',
            //     'Option C',
            //     'Option D',
            //     'option_1',
            //     'easy'
            // ]
        ];
    }
}
