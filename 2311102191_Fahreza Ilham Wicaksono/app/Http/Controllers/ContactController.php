<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $page = 'Contacts';
        $contacts = Contact::get();

        return view('dashboard.contacts.index', compact('page', 'contacts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'type' => 'required|string|in:email,github,linkedin,instagram',
            'value' => 'required|string',
            'icon' => 'required|string'
        ]);

        Contact::create($validatedData);

        return redirect()->route('contacts.index')->with('success', 'Contact created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Contact $contact)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Contact $contact)
    {
        $page = 'Contacts';

        return view('dashboard.contacts.edit', compact('page', 'contact'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Contact $contact)
    {
        $validatedData = $request->validate([
            'type' => 'required|string|in:email,github,linkedin,instagram',
            'value' => 'required|string',
            'icon' => 'required|string'
        ]);

        $contact->update($validatedData);

        return redirect()->route('contacts.index')->with('success', 'Contact updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Contact $contact)
    {
        //
    }
}
