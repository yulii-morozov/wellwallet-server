<?php

namespace App\Mail;

use App\Models\CustomerRequest as CustomerRequestModel;
use App\Models\Customer;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CustomerRequest extends Mailable
{
    use Queueable, SerializesModels;

    public $order;
    public $customer;

    public function __construct(CustomerRequestModel $order, Customer $customer)
    {
        $this->order = $order;
        $this->customer = $customer;
    }

    public function build()
    {
        return $this->subject('Your request Has Been Created')
                    ->markdown('emails.order_created')
                    ->with([
                        'order' => $this->order,
                        'customer' => $this->customer,
                    ]);
    }
}