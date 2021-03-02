<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Comic;

class ComicMail extends Mailable
{
    use Queueable, SerializesModels;

    public $comic;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Comic $comic)
    {
        $this->comic = $comic;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mail.comic');
    }
}
