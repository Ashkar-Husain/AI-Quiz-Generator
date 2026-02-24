<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function create_users()
    {
        return view('dashboard.create_users');
    }

    //* Add New User (Manual)
    function add_new_user(Request $request)
    {
        $request->validate([
            'user_name' => 'required|min:3',
            'email'     => 'required|email|unique:users,email',
            'password'  => 'required|min:6|confirmed'
        ]);

        $lastUser = User::orderBy('id', 'desc')->first();

        if (!$lastUser) {
            $user_id = 'QZ1001';
        } else {
            $lastNumber = (int) substr($lastUser->user_id, 2);
            $user_id = 'QZ' . ($lastNumber + 1);
        }

        User::create([
            'user_name' => $request->user_name,
            'email'     => $request->email,
            'password'  => Hash::make($request->password),
            'user_id'   => $user_id
        ]);

        return redirect()
            ->route('admin.dashboard.add_users')
            ->with('success', 'User added successfully!');
    }

    //* Testing mail
    public function test_mail()
    {
        $result = sendCustomMail(
            'ashkar@claraerp.com',
            'Test Subject',
            '<h1>Hello World</h1>',
            false,
            ['anujk21615@gmail.com'],
            [],
            // [public_path('sample.pdf')]
            ['https://www.w3.org/WAI/ER/tests/xhtml/testfiles/resources/pdf/dummy.pdf']
        );

        if ($result['status']) {
            echo "Mail Sent";
        } else {
            echo "Mail Failed: " . $result['message'];
        }
    }

    //!------ends
}
