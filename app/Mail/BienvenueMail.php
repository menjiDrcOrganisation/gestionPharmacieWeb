<?php




namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class BienvenueMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;

    /**
     * Créer une nouvelle instance.
     */
    public function __construct($user)
    {
        $this->user = $user;
    }

    /**
     * Construire le message.
     */
    public function build()
    {
        return $this->subject('Bienvenue sur notre plateforme 🎉')
                    ->view('Mail.bienvenue');
    }
}
