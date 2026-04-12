<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Contact;

class FeedbackController extends Controller
{
    //
    public function contact()
    {
        return view('users.Feedback');
    }
     public function store(Request $request)
    {
        // Validation
      $request->validate([
        'name' => 'required|string|min:3|max:100',
        'email' => 'required|email|max:150',
        'subject' => 'nullable|string|max:200',
        'priority' => 'nullable|in:Low,Medium,High',
        'message' => 'required|min:10|max:1000',
    ],[
        'name.required' => 'Please enter your full name',
        'email.required' => 'Email is required',
        'email.email' => 'Enter valid email address',
        'message.required' => 'Message cannot be empty',
        'message.min' => 'Message must be at least 10 characters',
    ]);

        // Store data
        Contact::create([
            'name' => $request->name,
            'email' => $request->email,
            'subject' => $request->subject,
            'priority' => $request->priority,
            'message' => $request->message,
        ]);

        return redirect()->back()->with('success','Message sent successfully!');
    }
}
