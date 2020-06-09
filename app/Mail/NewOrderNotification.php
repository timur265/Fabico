<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

use App\Model\Order;

class NewOrderNotification extends Mailable
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
        return $this->from(env('ADMIN_EMAIL'))
                    ->text('emails.orders.notification')
                    ->to(env('ADMIN_EMAIL'));
    }
}
