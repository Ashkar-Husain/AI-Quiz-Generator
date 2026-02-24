<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //* Admin Dashboard
    function admin_dashboard()
    {
        return  view('dashboard.index');
    }


    //* Create Quizzes
    public function create_quizzes()
    {
        return view('dashboard.create_quizzes');
    }

    //? User's Dashboard
    function user_dashboard()
    {
        return  view('normalUser.index');
    }
}
