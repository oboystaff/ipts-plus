<?php

namespace App\Jobs\Payment;

use App\Models\InvoicePayment;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Actions\SMS\SendSMS;

class SendPaymentSMS implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $payment;

    /**
     * Create a new job instance.
     */
    public function __construct(InvoicePayment $payment)
    {
        $this->payment = $payment;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $msg = "Thank you for paying your property Rate of GHS " . $this->payment->amount_paid . " to Ablekuma North Municipal ";
        $msg .= "Assembly. You still have a balance of GHS " . $this->payment->invoice->Balance . " to pay to complete your bill for the ";
        $msg .= "year " . date("Y") . ".";

        $phone = $this->payment->payment_phone_no;

        SendSMS::sendSMS($phone, $msg);
    }
}
