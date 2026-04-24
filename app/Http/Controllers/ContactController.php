<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class ContactController extends Controller
{
    public function store(Request $request)
    {
        // 1️⃣ Validate input
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string',
        ]);

        try {

            // 2️⃣ Send email
            Mail::raw(
                "Name: {$validated['name']}\nEmail: {$validated['email']}\n\nMessage:\n{$validated['message']}",
                function ($message) use ($validated) {
                    $message->to('kushal.81318@apollointcollege.edu.np')
                            ->subject('New Contact Message')
                            ->replyTo($validated['email']);
                }
            );

            return back()->with('success', 'Message sent successfully!');

        } catch (\Exception $e) {

            // 3️⃣ Log error instead of crashing site
            Log::error('Mail Error: ' . $e->getMessage());

            return back()->with('error', 'Failed to send message. Please try again later.');
        }
    }
}