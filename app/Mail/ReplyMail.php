<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ReplyMail extends Mailable
{
    use Queueable, SerializesModels;
    public $data;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $message = $this->data;
        return $this->from('samburakatexplore@gmail.com')->view('mail.message', compact('message'))
                    ->with(['name' => $message['name'], 'link' => $message['link']])
                    ->subject('Email From Lab Multimedia FASILKOM UNSRI');
    }
}
