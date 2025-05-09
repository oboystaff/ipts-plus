<!DOCTYPE html>
<html>

<head>
    <title>Ratepayer Bill Statement</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 100%;
            max-width: 800px;
            margin: 0 auto;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .header {
            text-align: center;
            background-color: #c35d0a;
            color: white;
            padding: 10px 0;
            border-radius: 8px 8px 0 0;
        }

        .content {
            padding: 20px;
            color: #333;
            line-height: 1.6;
        }

        .content h2 {
            color: #333;
            margin-top: 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center;
        }

        th {
            background-color: #c35d0a;
            color: white;
        }

        .footer {
            text-align: center;
            color: #888;
            font-size: 12px;
            padding: 10px 0;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h1>Ratepayer Payment Statement</h1>
        </div>

        <div class="content">
            <h2>Dear {{ $details['name'] }},</h2>
            <p>{{ $details['message'] }}</p>

            <p>Please review the payment statement below:</p>

            <table>
                <thead>
                    <tr>
                        <th>Bill ID</th>
                        <th>Payment Mode</th>
                        <th>Trans. Status</th>
                        <th>Amount</th>
                        <th>Payment Date</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($details['payments'] as $payment)
                        <tr>
                            <td>{{ $payment->bills_id }}</td>
                            <td>{{ $payment->payment_mode }}</td>
                            <td>{{ $payment->transaction_status }}</td>
                            <td>{{ number_format($payment->amount, 2) }}</td>
                            <td>{{ $payment->created_at }}</td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="2"></th>
                        <th>Total</th>
                        <th>{{ $details['total_amount'] }}</th>
                        <th></th>
                    </tr>
                </tfoot>
            </table>

            <p>Thank you !!!!</p>

            <p>Best Regards</p>
            <p>The IT Team</p>
        </div>

        <div class="footer">
            <p>This is an automated email. Please do not reply.</p>
            <p>&copy; {{ date('Y') }} Level 10 Technology. All rights reserved.</p>
        </div>
    </div>
</body>

</html>
