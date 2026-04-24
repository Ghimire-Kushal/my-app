<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class HomeController extends Controller
{
    public function index()
    {
        $projects = Project::latest()->get();
        return view('home', compact('projects'));
    }

    public function contact()
    {
        return view('contact');
    }

    public function sendContact(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'message' => 'required|string',
        ]);

        // ✅ Store in database
        $message = Message::create($validated);

        // ✅ Send email
        Mail::raw(
            "New Contact Message\n\nName: {$message->name}\nEmail: {$message->email}\n\nMessage:\n{$message->message}",
            function ($mail) {
                $mail->to('kushal.81318@apollointcollege.edu.np')
                     ->subject('New Contact Message');
            }
        );

        return back()->with('success', 'Message sent successfully!');
    }
}