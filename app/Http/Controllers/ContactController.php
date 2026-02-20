<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'message' => 'required',
        ]);

        Mail::raw(
            "Name: {$request->name}\nEmail: {$request->email}\n\n{$request->message}",
            function ($message) {
                $message->to('kushal.81318@apollointcollege.edu.np')
                        ->subject('New Contact Message');
            }
        );

        return back()->with('success', 'Message sent successfully!');
    }
}