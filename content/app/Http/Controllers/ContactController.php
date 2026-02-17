<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;

class ContactController extends Controller
{
    public function index()
    {
        return view('site.contact');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|email|max:255',
            'phone'   => 'nullable|string|max:50',
            'subject' => 'required|string|max:255',
            'message' => 'required|string|min:10',
        ], [
            'name.required'    => 'Veuillez entrer votre nom complet.',
            'email.required'   => 'Veuillez entrer votre adresse email.',
            'email.email'      => 'Veuillez entrer une adresse email valide.',
            'subject.required' => 'Veuillez indiquer l\'objet de votre message.',
            'message.required' => 'Veuillez écrire votre message.',
            'message.min'      => 'Votre message doit contenir au moins 10 caractères.',
        ]);

        Contact::create([
            'name'    => $request->name,
            'email'   => $request->email,
            'phone'   => $request->phone,
            'subject' => $request->subject,
            'message' => $request->message,
        ]);

        return redirect()->route('contact')->with('success', 'Votre message a été envoyé avec succès. Nous vous répondrons dans les plus brefs délais.');
    }
}
