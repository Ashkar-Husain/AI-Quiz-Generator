<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Smalot\PdfParser\Parser;

class QuizController extends Controller
{
    /**
     * Show PDF upload page
     */
    public function upload_pdf_page()
    {
        return view('dashboard.pdf.upload_pdf');
    }

    /**
     * Handle PDF upload & analysis
     */
    public function uploadPdf(Request $request)
    {
        // 1️⃣ Validate PDF
        $request->validate([
            'pdf' => 'required|mimes:pdf|max:10240', // 10MB
        ]);

        $pdf = $request->file('pdf');

        // 2️⃣ Extract text from PDF
        $parser = new Parser();
        $pdfText = $parser->parseFile($pdf->getPathname())->getText();

        // 3️⃣ Empty / unreadable PDF
        if (trim($pdfText) === '') {
            return back()->with('error', 'PDF is empty or unreadable');
        }

        // 4️⃣ Estimate how many questions can be generated
        $maxQuestions = $this->estimateQuestions($pdfText);

        if ($maxQuestions < 5) {
            return back()->with('error', 'PDF content is insufficient to generate a quiz');
        }

        // 5️⃣ Store data in session (temporary)
        session([
            'pdf_text'      => $pdfText,
            'max_questions' => $maxQuestions,
        ]);

        // 6️⃣ Go to quiz setup page
        return redirect('/quiz/setup');
    }

    /**
     * Quiz setup page (count + difficulty)
     */
    public function quizSetup()
    {
        if (!session()->has('pdf_text')) {
            return redirect()->route('admin.dashboard.upload_pdf')->with('error', 'Please upload a PDF first.');
        }

        return view('dashboard.pdf.quiz_setup');
    }

    /**
     * Start quiz (generate questions)
     */
    public function startQuiz(Request $request)
    {
        $request->validate([
            'total_questions' => 'required|integer|min:1',
            'difficulty'      => 'required|in:easy,medium,hard',
        ]);

        $pdfText   = session('pdf_text');
        $limit     = $request->total_questions;
        $difficulty = $request->difficulty;

        // Generate questions
        $questions = $this->generateQuestions($pdfText, $limit, $difficulty);

        // Store quiz questions
        session([
            'quiz_questions' => $questions,
            'difficulty'     => $difficulty,
        ]);

        return view('dashboard.pdf.start_quiz', compact('questions'));
    }

    /**
     * Estimate how many questions can be generated
     */
    private function estimateQuestions(string $text): int
    {
        // Normalize text
        $text = preg_replace('/\s+/', ' ', trim($text));

        // Split into sentences
        $sentences = preg_split('/(?<=[.?!])\s+/', $text);

        $count = 0;

        foreach ($sentences as $sentence) {
            if (strlen($sentence) >= 80) {
                $count++;
            }
        }

        // Reasonable limits
        if ($count < 5)  $count = 5;
        if ($count > 50) $count = 50;

        return $count;
    }



    private function generateQuestions(string $text, int $limit): array
    {
        $sentences = preg_split('/(?<=[.?!])\s+/', $text);
        $questions = [];

        foreach ($sentences as $sentence) {
            if (strlen($sentence) < 80) continue;

            $questions[] = [
                'question' => substr($sentence, 0, 120) . '?',
                'options' => [
                    'This is correct answer',
                    'Option B',
                    'Option C',
                    'Option D',
                ],
                'correct' => 0
            ];

            if (count($questions) >= $limit) break;
        }

        return $questions;
    }


    //? Generate Quiz (Welcome Page)
    // public function generate_quiz($topic_id)
    // {
    //     $topic_id = Crypt::decrypt($topic_id);
    //     $max_questions = 10;

    //     $topic = DB::table('topics')->select('icon','topic_name')->where('id',9)->get();

    //     $quizData = DB::table('questions as q')
    //         ->join('topics as t', 't.id', '=', 'q.topic_id')
    //         ->join('options as o', 'o.question_id', '=', 'q.id')
    //         ->select([
    //             't.topic_name',
    //             't.subject',
    //             't.difficulty_id',
    //             't.icon as topic_icon',
    //             't.topic_description',
    //             'q.id as question_id',
    //             'q.question',
    //             'o.option_1',
    //             'o.option_2',
    //             'o.option_3',
    //             'o.option_4',
    //             'o.correct_option'
    //         ])
    //         ->where('q.topic_id', $topic_id)
    //         ->inRandomOrder()
    //         ->limit($max_questions)
    //         ->get();



    //     return view('quiz', compact('quizData'));
    // }



    // public function generate_quiz($topic_id)
    // {
    //     $topic_id = Crypt::decrypt($topic_id);
    //     $max_questions = 10;

    //     // If user clicked Generate Quiz again → reset quiz
    //     if (request()->has('new')) {
    //         Session::forget('quiz_questions_' . $topic_id);
    //     }

    //     $topic = DB::table('topics')
    //         ->select('icon', 'topic_name')
    //         ->where('id', $topic_id)
    //         ->first();

    //     if (!Session::has('quiz_questions_' . $topic_id)) {

    //         $question_ids = DB::table('questions')
    //             ->where('topic_id', $topic_id)
    //             ->inRandomOrder()
    //             ->limit($max_questions)
    //             ->pluck('id')
    //             ->toArray();

    //         Session::put('quiz_questions_' . $topic_id, $question_ids);
    //     } else {
    //         $question_ids = Session::get('quiz_questions_' . $topic_id);
    //     }

    //     $quizData = DB::table('questions as q')
    //         ->join('topics as t', 't.id', '=', 'q.topic_id')
    //         ->join('options as o', 'o.question_id', '=', 'q.id')
    //         ->select([
    //             't.topic_name',
    //             't.subject',
    //             't.difficulty_id',
    //             't.icon as topic_icon',
    //             't.topic_description',
    //             'q.id as question_id',
    //             'q.question',
    //             'o.option_1',
    //             'o.option_2',
    //             'o.option_3',
    //             'o.option_4',
    //             'o.correct_option'
    //         ])
    //         ->whereIn('q.id', $question_ids)
    //         ->get();

    //     return view('quiz', compact('quizData', 'topic'));
    // }


    public function start_quiz($topic_id)
    {
        $topic_id = Crypt::decrypt($topic_id);

        Session::forget('quiz_questions_' . $topic_id);

        return redirect()->route('generate_quiz', encrypt($topic_id));
    }


    public function generate_quiz($topic_id)
    {
        $topic_id = Crypt::decrypt($topic_id);
        $max_questions = 10;

        $session_key = 'quiz_questions_' . $topic_id;

        $topic = DB::table('topics')
            ->select('icon', 'topic_name')
            ->where('id', $topic_id)
            ->first();

        if (!Session::has($session_key)) {

            $question_ids = DB::table('questions')
                ->where('topic_id', $topic_id)
                ->inRandomOrder()
                ->limit($max_questions)
                ->pluck('id')
                ->toArray();

            Session::put($session_key, $question_ids);
        } else {
            $question_ids = Session::get($session_key);
        }

        $quizData = DB::table('questions as q')
            ->join('options as o', 'o.question_id', '=', 'q.id')
            ->select(
                'q.id as question_id',
                'q.question',
                'o.option_1',
                'o.option_2',
                'o.option_3',
                'o.option_4',
                'o.correct_option'
            )
            ->whereIn('q.id', $question_ids)
            ->orderByRaw("FIELD(q.id," . implode(',', $question_ids) . ")")
            ->get();

        return view('quiz', compact('quizData', 'topic'));
    }

    //!-------------ends
}
