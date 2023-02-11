<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CertificateClearenceLaboratoryMail extends Mailable
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
        $certificate = $this->data;
        return $this->from('samburakatexplore@gmail.com')->view('mail.certificate-clearence-laboratory', compact('certificate'))
                    ->with(['name' => $certificate['name'], 'link' => $certificate['link']])
                    ->subject('Email From Lab Multimedia FASILKOM UNSRI');
    }
}
