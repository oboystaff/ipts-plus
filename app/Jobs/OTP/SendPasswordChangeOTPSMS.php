<?php

namespace App\Jobs\OTP;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Actions\SMS\SendSMS;
use App\Models\OTP;


class SendPasswordChangeOTPSMS implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $user;

    /**
     * Create a new job instance.
     */
    public function __construct($user)
    {
        $this->user = $user;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $otp = mt_rand(100000, 999999);

        $data = [
            'citizen_id' => $this->user->id,
            'code' => $otp
        ];

        $otpData = OTP::create($data);

        $msg = "Your password change OTP code is " . $otpData->code;

        $phone = $this->user->phone;

        SendSMS::sendSMS($phone, $msg);
    }
}
