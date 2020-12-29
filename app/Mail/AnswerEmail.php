<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AnswerEmail extends Mailable
{
    use Queueable, SerializesModels;
    protected $input;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($input)
    {
        $this->input = $input;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $data = [
            'answer' => $this->input['answer'],
            'admin' => $this->input['admin'],
            'customer' => User::find($this->input['user_id'])->name,
            'content' => $this->input['question']
        ];
        return $this->view('mail.answer')->with($data);
    }
}
