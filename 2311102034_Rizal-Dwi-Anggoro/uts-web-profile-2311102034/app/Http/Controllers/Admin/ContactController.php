<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contact;

class ContactController extends Controller
{
    public function show()
    {
        $contact = Contact::first();
        return response()->json(['data' => $contact ?: (object)[]]);
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'email'    => 'nullable|email|max:150',
            'linkedin' => 'nullable|string|max:300',
            'github'   => 'nullable|string|max:300',
            'whatsapp' => 'nullable|string|max:20',
            'twitter'  => 'nullable|string|max:300',
        ]);

        $contact = Contact::first();
        if ($contact) {
            $contact->update($data);
        } else {
            $contact = Contact::create($data);
        }

        return response()->json(['data' => $contact, 'message' => 'Contact updated']);
    }
}