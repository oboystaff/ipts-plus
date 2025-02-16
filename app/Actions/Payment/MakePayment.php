<?php

namespace App\Actions\Payment;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class MakePayment
{
    public static function acceptPayment($amount, $transactionId, $subscriberNumber, $network)
    {
        try {
            $apiUsernameProd = "level679ceeb70a0e9";
            $apiKeyProd = "MjkzMjM5M2M0MmFjNjM3ZGEzZDhiNjdiOTU3NmNiMTE=";

            // $apiUsername = "level679ceeb70a0e9";
            // $apiKey = "NjI5YzM5ODA1NzNmNDU4OGQ5MWNjMzdhYzFhNTI0YmU=";

            $merchantID = "TTM-00010135";
            $callback_url = route('payments.callback');

            $base64Credentials = base64_encode("$apiUsernameProd:$apiKeyProd");

            $url = "https://prod2.theteller.net/process/transaction/async";

            $headers = [
                'Content-Type' => 'application/json',
                'Authorization' => "Basic $base64Credentials",
                'Cache-Control' => 'no-cache',
                "request-id" =>  $transactionId
            ];

            $payload = [
                "amount" =>  $amount,
                "processing_code" => "000200",
                "transaction_id" => (string) $transactionId,
                "desc" => "Rate payer bill payment",
                "merchant_id" => $merchantID,
                "callback_url" => $callback_url,
                "subscriber_number" => $subscriberNumber,
                "r-switch" => $network,
                "reference" => "Rate payer bill payment",
                "merchant_data" => json_encode([]),
            ];

            $response = Http::withHeaders($headers)->post($url, $payload)->json();

            return $response;
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
