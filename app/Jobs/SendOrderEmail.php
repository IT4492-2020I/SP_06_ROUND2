<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Log;
use Mail;
use App\Mail\OrderMail;


class SendOrderEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    
    protected $order;
    protected $reason;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($order, $reason = null)
    {
        $this->order = $order;
        $this->reason = $reason;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $email = new OrderMail($this->order, $this->reason);
        Mail::to($this->order->user->email)->send($email);
    
    }
}
