<?php

namespace App\Mail;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class OrderUpdate extends Mailable
{
    use Queueable, SerializesModels;
    public $newOrder;
    public $status;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Order $newOrder, $status)
    {
        $this->newOrder = $newOrder;
        $this->status = $status;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Your order status has been updated')->view('mail.order-update');
    }
}
