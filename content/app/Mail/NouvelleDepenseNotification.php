<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NouvelleDepenseNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $depense;
    public $utilisateur;
    public $magasin;

    /**
     * Create a new message instance.
     */
    public function __construct($depense, $utilisateur, $magasin)
    {
        $this->depense = $depense;
        $this->utilisateur = $utilisateur;
        $this->magasin = $magasin;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this->subject('Nouvelle Dépense en Attente de Validation')
                    ->view('emails.nouvelle_depense');
    }
}