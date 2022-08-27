<?php

namespace App\Mail;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class OrderInvoice extends Mailable
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
        return $this->subject('Thank you for your purchase! Your order has been confirmed')->view('mail.order-invoice');
    }
}
