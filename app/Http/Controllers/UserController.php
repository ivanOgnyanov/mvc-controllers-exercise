<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function create()
    {
        return view('pages.register');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|min:2',
            'email' => 'required|email',
            'password' => 'required|min:6|confirmed',
        ]);

        return back()->with('success', 'Успешна регистрация!');
    }
}
