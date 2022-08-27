<?php

namespace App\Jobs;

use App\Models\Order;
use App\Mail\OrderUpdate;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class SendOrderUpdate implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    protected $newOrder;
    protected $user;
    protected $status;
    public function __construct(Order $newOrder, $user, $status)
    {
        $this->newOrder = $newOrder;
        $this->user = $user;
        $this->status = $status;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $email = new OrderUpdate($this->newOrder, $this->status);
        Mail::to($this->user)->send($email);
    }
}
