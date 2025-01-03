<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Receipt</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        .receipt-container {
            max-width: 600px;
            margin: 40px auto;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            border: 1px solid #ddd;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .header h1 {
            font-size: 24px;
            color: #007BFF;
            margin: 0;
        }

        .header p {
            font-size: 14px;
            color: #555;
            margin: 5px 0;
        }

        .receipt-details {
            margin-bottom: 20px;
            font-size: 14px;
        }

        .receipt-details .row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
        }

        .receipt-details span {
            display: inline-block;
            color: #333;
        }

        .summary {
            background-color: #f9f9f9;
            padding: 15px;
            border-radius: 5px;
            border: 1px solid #ddd;
            margin-bottom: 20px;
        }

        .summary h3 {
            font-size: 18px;
            color: #007BFF;
            margin: 0 0 10px;
            text-align: center;
        }

        .summary p {
            font-size: 16px;
            margin: 5px 0;
            text-align: center;
            color: #444;
        }

        .footer {
            text-align: center;
            font-size: 12px;
            color: #777;
        }

        @media print {
            .receipt-container {
                border: none;
                box-shadow: none;
                margin: 0;
            }

            body {
                background-color: #ffffff;
            }
        }
    </style>
</head>

<body>
    @php
        $billType = '';
        $name = '';
        $totalDue = 0;

        if ($payment->bill->property_id !== null) {
            $firstname = $payment->bill->property->customer->first_name ?? '';
            $lastname = $payment->bill->property->customer->last_name ?? '';
            $billType = 'Property Bill';
        } else {
            $firstname = $payment->bill->business->customer->first_name ?? '';
            $lastname = $payment->bill->business->customer->last_name ?? '';
            $billType = 'Business Bill';
        }

        $name = $firstname . ' ' . $lastname;
        $totalDue = $payment->bill->arrears + $payment->bill->amount;
    @endphp

    <div class="receipt-container">
        <!-- Header -->
        <div class="header">
            <h1>Payment Receipt</h1>
            <p>{{ $payment->bill->assembly->name ?? 'District Assembly' }}</p>
            <p><strong>Address:</strong> {{ $payment->bill->assembly->address ?? 'N/A' }} | <strong>Phone:</strong>
                {{ $payment->bill->assembly->phone ?? 'N/A' }}</p>
        </div>

        <!-- Receipt Details -->
        <div class="receipt-details">
            <div class="row">
                <span><strong>Receipt No:</strong> {{ $payment->bill->bills_id }}</span>
                <span><strong>Date:</strong> {{ now()->format('d M, Y') }}</span>
            </div>
            <div class="row">
                <span><strong>Customer Name:</strong> {{ $name }}</span>
                <span><strong>Payment Mode:</strong> {{ ucfirst($payment->payment_mode) }}</span>
            </div>
        </div>

        <!-- Payment Summary -->
        <div class="summary">
            <h3>Payment Summary</h3>
            <p><strong>Amount Paid:</strong> GHS {{ number_format($payment->amount, 2) }}</p>
        </div>

        <!-- Footer -->
        <div class="footer">
            <p>Thank you for your payment!</p>
            <p>This receipt is system generated and does not require a signature.</p>
        </div>
    </div>
</body>

</html>
