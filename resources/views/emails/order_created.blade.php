@component('mail::message')
# Order Created Successfully

Dear {{ $customer->first_name }} {{ $customer->last_name }},

Thank you for your order! We have successfully received your order with the following details:

**Order ID:** {{ $order->id }}  
**Type:** {{ $order->type->value }}  
**Source:** {{ $order->source->value }}  
**Status:** {{ $order->status->value }}  

We will keep you updated on the progress of your order.

Best regards,  
Your Company Name

@component('mail::button', ['url' => config('app.url')])
Visit Our Website
@endcomponent

@endcomponent