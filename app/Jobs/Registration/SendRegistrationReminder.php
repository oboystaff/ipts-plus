<?php

namespace App\Jobs\Registration;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Actions\SMS\SendSMS;

class SendRegistrationReminder implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    protected $citizen;

    public function __construct($citizen)
    {
        $this->citizen = $citizen;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $msg = "Hello " . $this->citizen->first_name . ",";
        $msg .= " Thanks for registering on ERMS PLUS, your Account No. is: " . $this->citizen->account_number . ".";
        $msg .= " You can use your phone number " . $this->citizen->telephone_number . " or Account No. and default";
        $msg .= " password: " . env('DEFAULT_PASSWORD') . " to login at  www.app.melchia.com";
        $msg .= " For further inquiries, please call this number " . env('COMPANY_CONTACT');

        $phone = $this->citizen->telephone_number;

        SendSMS::sendSMS($phone, $msg);
    }
}
