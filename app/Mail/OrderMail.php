<?php

namespace App\Mail;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Log;

class OrderMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $order;
    protected $reason;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($order, $reason = null)
    {
        $this->order = $order;
        $this->reason = $reason;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $data = [
            'order' => $this->order,
            'status' => Order::$status,
            'reason' => $this->reason,
            'url' => Order::$statusUrl
        ];
        
        return $this->view('mail.order')->with($data);
    }
}
