<?php

namespace App\Mail;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class OrderNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $newOrder;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Order $newOrder)
    {
        $this->newOrder = $newOrder;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('You have a new order')->view('mail.new-order');
    }
}
