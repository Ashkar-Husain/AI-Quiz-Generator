<?php

namespace App\Http\Controllers;

use App\Models\Option;
use App\Models\Question;
use App\Models\Topic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;

class DashboardController extends Controller
{
    //* Admin Dashboard
    function admin_dashboard()
    {
        $data['topics'] = DB::table('topics')->select('id', 'topic_name', 'subject', 'difficulty_id', 'topic_description', 'taken_count', 'rating', 'icon', 'created_at', 'created_by')->get();
        if (View::exists('dashboard.index')) {
            return  view('dashboard.index', $data);
        } else {
            return response()->view('errors.fallback', [
                'message' => 'Page under development. Please try again later.'
            ], 200);
        }
    }

    //* Create Topics
    function add_new_topic()
    {
        $data['difficulties'] = get_difficulties();
        if (View::exists('dashboard.topics.create_topics')) {
            return view('dashboard.topics.create_topics', $data);
        }

        // Fallback response
        return response()->view('errors.fallback', [
            'message' => 'Page under development. Please try again later.'
        ], 200);
    }

    //* Store topics in database
    function store_new_topic(Request $request)
    {
        $request->validate([
            'topic' => 'required',
            'subject' => 'required',
            'difficulty' => 'required|in:1,2,3',
            'description' => 'required',
        ]);

        Topic::create([
            'branch_id' => 'Main Branch',
            'topic_name' => $request->topic,
            'subject' => $request->subject,
            'difficulty_id' => $request->difficulty,
            'topic_description' => $request->description,
            'icon' => $request->font_icon,
            'created_at' => date("Y-m-d H:i:s"),
            'created_by' => Auth::user()->user_id
        ]);

        return redirect()->back()->with('success', 'Topic added successfully');
    }

    //* Create Quizzes
    public function create_quizzes()
    {
        $topics = DB::table('topics')->select('id', 'topic_name')->get();
        if (View::exists('dashboard.create_quizzes')) {
            return view('dashboard.create_quizzes', compact('topics'));
        } else {
            return response()->view('errors.fallback', [
                'message' => 'Page under development. Please try again later.'
            ], 200);
        }
    }

    public function create_quizzes_manual(Request $request)
    {
        // validation
        $request->validate([
            'topic_id' => 'required',
            'question' => 'required',
            'option1' => 'required',
            'option2' => 'required',
            'option3' => 'required',
            'option4' => 'required',
            'correct_answer' => 'required|in:1,2,3,4'
        ]);

        // insert question
        $question = Question::create([
            'branch_id' => 'Main Branch',
            'topic_id' => $request->topic_id,
            'question' => $request->question,
            'created_at' => date("Y-m-d H:i:s")
        ]);

        // insert options and map question_id
        Option::create([
            'branch_id' => 'Main Branch',
            'question_id' => $question->id,
            'topic_id' => 1,
            'option_1' => $request->option1,
            'option_2' => $request->option2,
            'option_3' => $request->option3,
            'option_4' => $request->option4,
            'correct_option' => $request->correct_answer,
            'created_by' => Auth::user()->user_id,
            'created_at' => date("Y-m-d H:i:s")
        ]);

        return redirect()->back()->with('success', 'Quiz added successfully');
    }
    //? User's Dashboard
    function user_dashboard()
    {
        return  view('normalUser.index');
    }
}
