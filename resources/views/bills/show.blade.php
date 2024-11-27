<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bill Receipt</title>
    <style>
        /* General Reset */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        .receipt-container {
            max-width: 500px;
            margin: 30px auto;
            background: #ffffff;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            border: 1px solid #ddd;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .header h1 {
            font-size: 20px;
            margin: 0;
            color: #333;
        }

        .header p {
            font-size: 14px;
            margin: 5px 0;
            color: #555;
        }

        .receipt-info {
            margin-bottom: 20px;
            font-size: 14px;
        }

        .receipt-info .row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 8px;
        }

        .receipt-info strong {
            color: #444;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .table th,
        .table td {
            padding: 10px;
            text-align: left;
            border: 1px solid #ddd;
        }

        .table th {
            background-color: #f8f8f8;
            font-size: 14px;
            font-weight: bold;
            color: #333;
        }

        .table td {
            font-size: 13px;
        }

        .total {
            font-size: 16px;
            font-weight: bold;
            text-align: right;
            margin-top: 10px;
        }

        .footer {
            text-align: center;
            font-size: 12px;
            color: #777;
            margin-top: 20px;
        }

        @media print {
            .receipt-container {
                border: none;
                box-shadow: none;
                margin: 0;
            }
        }
    </style>
</head>

<body>
    @php
        $billType = '';
        $name = '';
        $totalDue = 0;

        if ($bill->property_id !== null) {
            $firstname = $bill->property->customer->first_name ?? '';
            $lastname = $bill->property->customer->last_name ?? '';
            $billType = 'Property Bill';
        } else {
            $firstname = $bill->business->customer->first_name ?? '';
            $lastname = $bill->business->customer->last_name ?? '';
            $billType = 'Business Bill';
        }

        $name = $firstname . ' ' . $lastname;
        $totalDue = $bill->arrears + $bill->amount;
    @endphp

    <div class="receipt-container">
        <!-- Header Section -->
        <div class="header">
            <h1>Billing Receipt</h1>
            <p>{{ $bill->assembly->name ?? 'N/A' }} | Address | Contact</p>
        </div>

        <!-- Receipt Information -->
        <div class="receipt-info">
            <div class="row">
                <span><strong>Bill No:</strong> {{ $bill->bills_id }}</span>
                <span><strong>Year:</strong> {{ $bill->bills_year }}</span>
            </div>
            <div class="row">
                <span><strong>Customer Name:</strong> {{ $name }}</span>
                <span><strong>Bill Type:</strong> {{ $billType }}</span>
            </div>
        </div>

        <!-- Bill Table -->
        <table class="table">
            <thead>
                <tr>
                    <th>Description</th>
                    <th>Amount (GHS)</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Arrears</td>
                    <td>{{ number_format($bill->arrears, 2) }}</td>
                </tr>
                <tr>
                    <td>Current Amount</td>
                    <td>{{ number_format($bill->amount, 2) }}</td>
                </tr>
                <tr>
                    <td><strong>Amount Due</strong></td>
                    <td><strong>{{ number_format($totalDue, 2) }}</strong></td>
                </tr>
            </tbody>
        </table>

        <!-- Total Section -->
        <div class="total">
            <p>Total Due: GHS {{ number_format($totalDue, 2) }}</p>
        </div>

        <!-- Footer Section -->
        <div class="footer">
            <p>Please make your payment at your earliest convenience.</p>
            <p>This receipt was generated electronically and is valid without a signature.</p>
        </div>
    </div>
</body>

</html>
