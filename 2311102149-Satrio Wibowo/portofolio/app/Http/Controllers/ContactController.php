<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ContactMessage;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'         => ['required', 'string', 'max:255'],
            'email'        => ['required', 'email', 'max:255'],
            'project_type' => ['nullable', 'string', 'max:255'],
            'message'      => ['required', 'string', 'min:10'],
        ]);

        $contact = ContactMessage::create($validated);

        // OPTIONAL: kirim email ke kamu
        // Uncomment kalau mail sudah dikonfigurasi

        /*
        Mail::raw(
            "New message from {$contact->name}\n\n".
            "Email: {$contact->email}\n".
            "Project Type: {$contact->project_type}\n\n".
            "Message:\n{$contact->message}",
            function ($message) {
                $message->to('your@email.com')
                        ->subject('New Contact Message');
            }
        );
        */

        return back()->with('success', 'Message sent successfully! I will get back to you soon.');
    }
}
