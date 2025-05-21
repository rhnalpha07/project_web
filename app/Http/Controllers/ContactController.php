<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function show()
    {
        return view('contact');
    }

    public function send(Request $request)
    {
        // Validate the form data
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);
        
        // For now, we'll just redirect with a success message
        // In a real application, you would send an email here
        /*
        Mail::send('emails.contact', $validated, function ($message) use ($validated) {
            $message->from($validated['email'], $validated['name']);
            $message->to('info@bookstore.com');
            $message->subject($validated['subject']);
        });
        */
        
        return redirect()->back()->with('success', 'Thank you for your message! We will get back to you soon.');
    }
} 