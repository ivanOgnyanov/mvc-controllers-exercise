<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email|min:16|max:100',
        ]);

        return back()->with('success', 'Успешно се абонирахте!');
    }
}
