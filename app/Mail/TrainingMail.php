<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TrainingMail extends Mailable
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
        $training = $this->data;
        return $this->from('samburakatexplore@gmail.com')->view('mail.training', compact('training'))
                    ->with(['name' => $training['name'], 
                            'title' => $training['title'], 
                            'date' => $training['date'],
                            'place' => $training['place'],
                            'whatsapp' => $training['whatsapp'], 
                            'zoom' => $training['zoom']])
                    ->subject('Email From Lab Multimedia FASILKOM UNSRI');
    }
}
