<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewsMail extends Mailable
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
        $news = $this->data;
        return $this->from('samburakatexplore@gmail.com')->view('mail.news', compact('news'))
                    ->with(['link' => $news['link'], 'title' => $news['title'], 'excerpt' => $news['excerpt'], 'created_at' => $news['created_at']])
                    ->subject('Berita Terbaru dari Lab Multimedia FASILKOM UNSRI');
    }
}
