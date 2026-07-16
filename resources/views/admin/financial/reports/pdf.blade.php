<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">

    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
        }

        h1 {
            text-align: center;
        }

        .summary {
            margin-bottom: 25px;
        }

        .summary p {
            margin: 5px 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
        }

        th {
            background: #f3f4f6;
        }

        .income {
            color: green;
        }

        .expense {
            color: red;
        }
    </style>
</head>

<body>

    <div style="text-align: center; margin-bottom: 20px;">

        <img
            src="{{ public_path('images/vDC.png') }}"
            style="width: 180px; height: auto;">

    </div>

    <h1
        style="
        text-align: center;
        color: #163b69;
        font-size: 24px;
        margin: 0;
    ">
        VICTORY DISTRICT CHURCH
        <br>
        FINANCIAL REPORT
    </h1>

    <div
        style="
        width: 120px;
        height: 4px;
        background: #d4af37;
        margin: 15px auto 30px auto;
    "></div>

    <p>
        Period:
        {{ $from->format('d M Y') }}
        -
        {{ $to->format('d M Y') }}
    </p>
    <p>
        Generated:
        {{ now()->format('d M Y h:i A') }}
    </p>

    <p>
        Report ID:
        FIN-{{ now()->format('YmdHis') }}
    </p>

    <div class="summary">
        <p><strong>Total Income:</strong> ₦{{ number_format($income, 2) }}</p>
        <p><strong>Total Expenses:</strong> ₦{{ number_format($expenses, 2) }}</p>
        @if($balance < 0)
            <p>
            <strong>Deficit:</strong>
            <span style="color:red;">
                ₦{{ number_format(abs($balance), 2) }}
            </span>
            </p>
            @else
            <p>
                <strong>Balance:</strong>
                <span style="color:green;">
                    ₦{{ number_format($balance, 2) }}
                </span>
            </p>
            @endif
    </div>

    <table>
        <thead>
            <tr>
                <th>Date</th>
                <th>Description</th>
                <th>Category</th>
                <th>Type</th>
                <th>Amount</th>
            </tr>
        </thead>

        <tbody>

            @foreach($transactions as $transaction)

            <tr>
                <td>
                    {{ $transaction->transaction_date->format('d M Y') }}
                </td>

                <td>
                    {{ $transaction->description }}
                </td>

                <td>
                    {{ $transaction->fundCategory?->name ?? 'N/A' }}
                </td>

                <td>
                    {{ ucfirst($transaction->transaction_type) }}
                </td>

                <td>
                    ₦{{ number_format($transaction->amount, 2) }}
                </td>
            </tr>

            @endforeach

        </tbody>
    </table>

    <div style="margin-top:80px;">
        <table width="100%">
            <tr>
                <td>
                    ______________________<br>
                    Church Treasurer
                </td>

                <td align="right">
                    ______________________<br>
                    Senior Pastor
                </td>
            </tr>
        </table>
    </div>

</body>

</html>