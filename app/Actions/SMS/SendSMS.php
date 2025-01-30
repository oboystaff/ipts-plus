<?php

namespace App\Actions\SMS;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class SendSMS
{

    public static function sendSMS($msisdn, $msg)
    {
        try {
            //CALL THE API
            $key = env("SMS_API_KEY");
            $senderid = env("SENDER_ID");
            $API_URL = "https://txtconnect.net/dev/api/sms/send";
            $body = array("to" => $msisdn, "from" => $senderid, "unicode" => 0, "sms" => $msg);

            $resp = Http::withToken($key)->post($API_URL, $body)->json();

            //Log::info($resp);
            return $resp;
        } catch (\Exception $ex) {
            return response()->json([
                'message' => 'Unable to deliver sms to customer ' . $ex->getMessage(),
            ], 422);
        }
    }
}
