<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class ContactController extends Controller
{
    public function store(Request $request)
    {
        // ✅ Validate input
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string',
        ]);

        try {

            // ✅ Send email
            Mail::raw(
                "New Contact Message\n\n" .
                "Name: {$validated['name']}\n" .
                "Email: {$validated['email']}\n\n" .
                "Message:\n{$validated['message']}",
                function ($message) use ($validated) {

                    $message->to('kushal.upr@gmail.com') // ✅ RECEIVE HERE
                            ->subject('📩 New Contact Message')
                            ->replyTo($validated['email'], $validated['name']);
                }
            );

            return back()->with('success', '✅ Message sent successfully!');

        } catch (\Exception $e) {

            // ✅ Log full error (VERY IMPORTANT)
            Log::error('MAIL ERROR: ' . $e->getMessage());

            return back()->with('error', '❌ Failed to send message. Please try again later.');
        }
    }
}
