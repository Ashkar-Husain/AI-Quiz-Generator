<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class DashboardController extends Controller
{
    //* Admin Dashboard
    function admin_dashboard()
    {
        return  view('dashboard.index');
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

    //* Create Quizzes
    public function create_quizzes()
    {
        if (View::exists('dashboard.create_quizzes')) {
            return view('dashboard.create_quizzes');
        } else {
            return response()->view('errors.fallback', [
                'message' => 'Page under development. Please try again later.'
            ], 200);
        }
    }

    //? User's Dashboard
    function user_dashboard()
    {
        return  view('normalUser.index');
    }
}
