<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

use App\Model\Order;

class OrderConfirmed extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * The order instance
     *
     * @var Order
    */
    public $order;

    /**
     * Admin e-mail address
     * 
     * @var string
     */
    public $adminEmail;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Order $order, string $adminEmail)
    {
        $this->order = $order;
        $this->adminEmail = $adminEmail;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from($this->adminEmail)
                    ->text('emails.orders.confirmed')
                    ->to($this->order->email);
    }
}
