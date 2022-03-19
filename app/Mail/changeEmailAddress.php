<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class changeEmailAddress extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user, $newEmail)
    {
        $this->user = $user;
        $this->futureNewEmailAddress = $newEmail;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mails.changeEmailAddress')
            ->with([
                'user' => $this->user,
                'newEmail' => $this->futureNewEmailAddress
            ]);
    }
}
