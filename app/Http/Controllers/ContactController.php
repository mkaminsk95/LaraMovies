<?php

namespace App\Http\Controllers;

use App\Mail\ContactMessage;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function edit(): View
    {
        return view('contact');
    }

    public function store(Request $request): \Illuminate\Http\RedirectResponse
    {
        $request->validate([
            'first-name' => 'required',
            'last-name' => 'required',
            'user-email' => 'required|email',
            'message' => 'required',
        ]);

        $details = $request->all();
        Mail::send(new ContactMessage([
            'firstName' => $details['first-name'],
            'lastName' => $details['last-name'],
            'company' => $details['company'],
            'userEmail' => $details['user-email'],
            'message' => $details['message'],
        ]));

        return redirect()->route('contact.edit')->with('success', __('Your message has been sent successfully. We will contact you soon.'));
    }
}
