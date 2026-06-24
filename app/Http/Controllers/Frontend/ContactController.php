<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contact;

class ContactController extends Controller
{
    public function submit(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string',
            'phone' => 'nullable|string|max:20',
            'businessname' => 'nullable|string|max:255',
            'services' => 'nullable|string|max:255',
            'website' => 'nullable|string|max:255',
        ]);

        $contact = Contact::create([
            'name' => $request->name,
            'email' => $request->email,
            'message' => $request->message,
            'phone' => $request->phone,
            'businessname' => $request->businessname,
            'services' => $request->services,
            'website' => $request->website,
        ]);

        try {
            \Illuminate\Support\Facades\Mail::to('hr.dgs24@gmail.com')->send(new \App\Mail\ContactSubmitted($contact));
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Contact form email notification failed: ' . $e->getMessage());
        }

        return redirect()->back()->with('success', 'Thank you for contacting us! We will get back to you shortly.');
    }
}
