<?php

namespace App\Actions\Payment;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class MakePayment
{
    public static function acceptPayment()
    {
        try {
            $apiUsername = "level679ceeb70a0e9";
            $apiKey = "NjI5YzM5ODA1NzNmNDU4OGQ5MWNjMzdhYzFhNTI0YmU=";
            $merchantID = "TTM-00010135";
            $transactionID = str_pad(mt_rand(1, 999999999999), 12, '0', STR_PAD_LEFT);
            $amount = str_pad(100, 12, '0', STR_PAD_LEFT);

            $base64Credentials = base64_encode("$apiUsername:$apiKey");

            $url = "https://test.theteller.net/v1.1/transaction/process";

            $headers = [
                'Content-Type' => 'application/json',
                'Authorization' => "Basic $base64Credentials",
                'Cache-Control' => 'no-cache',
            ];

            $body = [
                "amount" => $amount,
                "processing_code" => "000200",
                "transaction_id" => $transactionID,
                "desc" => "Mobile Money Payment Test",
                "merchant_id" => $merchantID,
                "subscriber_number" => "233248593031",
                "r-switch" => "MTN"
            ];

            $response = Http::withHeaders($headers)->post($url, $body);

            if ($response->successful()) {
                return $response->json();
            } else {
                return [
                    'status' => 'error',
                    'message' => 'Transaction failed',
                    'error' => $response->body()
                ];
            }
        } catch (\Exception $ex) {
            return $ex->getMessage();
        }
    }

    public static function checkPaymentStatus()
    {
        $transaction_id = "your_transaction_id";
        $client_id = "your_client_id";
        $client_secret = "your_client_secret";

        $url = "https://api.theteller.net/v1.1/transaction/$transaction_id/status";

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            "Authorization: Basic " . base64_encode("$client_id:$client_secret"),
            "Content-Type: application/json"
        ]);

        $response = curl_exec($ch);
        curl_close($ch);

        $result = json_decode($response, true);
        if ($result && $result['status'] == "approved") {
            echo "MoMo Payment successful";
        } else {
            echo "MoMo Payment failed";
        }
    }
}
