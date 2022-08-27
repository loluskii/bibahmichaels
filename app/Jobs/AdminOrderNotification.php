<?php

namespace App\Jobs;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use App\Mail\OrderNotification;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class AdminOrderNotification implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    protected $newOrder;
    protected $admin;
    public function __construct(Order $newOrder, $admin)
    {
        $this->newOrder = $newOrder;
        $this->admin = $admin;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $email = new OrderNotification($this->newOrder);
        Mail::to($this->admin)->send($email);
    }
}
