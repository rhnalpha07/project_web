<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NewsletterController extends Controller
{
    public function subscribe(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email|max:255',
        ]);

        // Here you would typically:
        // 1. Store the email in your newsletter subscribers table
        // 2. Maybe integrate with a newsletter service like Mailchimp
        
        return back()->with('success', 'Thank you for subscribing to our newsletter!');
    }
} 