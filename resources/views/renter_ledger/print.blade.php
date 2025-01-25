<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Print Ledger</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        h1,
        h4 {
            text-align: center;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
        }

        .row {
            display: flex;
            flex-direction: row;
            justify-content: space-evenly;
        }

        .info-section {
            margin-bottom: 20px;
            /* border: 1px solid #000; */
            padding: 10px;
        }

        .info-section h4 {
            margin: 0 0 10px;
        }

        .info-section p {
            margin: 5px 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table,
        th,
        td {
            border: 1px solid #000;
        }

        th,
        td {
            text-align: left;
            padding: 8px;
        }

        th {
            background-color: #f2f2f2;
        }

        .btn-print {
            display: block;
            margin: 20px auto;
            padding: 10px 20px;
            font-size: 16px;
            color: #fff;
            background-color: #007bff;
            border: none;
            cursor: pointer;
            border-radius: 4px;
        }

        .btn-print:hover {
            background-color: #0056b3;
        }

        @media print {
            .btn-print {
                display: none;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>AGREEMENT LEDGER</h1>
        <div class="row">
            <!-- Agreement Information -->
            <div class="info-section">
                <h5>Basic Info</h5>
                <p><strong>Agreement ID:</strong> {{ $rent->id }}</p>
                <p><strong>House Name:</strong> {{ $rent->rent->house->house_name ?? 'N/A' }}</p>
                <p><strong>Floor:</strong> {{ $rent->rent->floor->name ?? 'N/A' }}</p>
                <p><strong>Unit:</strong> {{ $rent->rent->unit->name ?? 'N/A' }}</p>
                <p><strong>Advance Amount:</strong> {{ number_format($rent->advance_amount, 2) }}</p>
                <p><strong>Rent Amount:</strong> {{ number_format($rent->total_amount, 2) }}</p>
                <p><strong>Extra Charge:</strong> {{ number_format($rent->extra_charge, 2) }}</p>
            </div>

            <!-- Agreement Information -->
            <div class="info-section">
                <h5>Agreement Info</h5>
                <p><strong>Agreement Date:</strong> {{ $rent->agreement_date }}</p>
                <p><strong>Rent Increment (Months):</strong> {{ $rent->increment_months ?? 'N/A' }}</p>
                <p><strong>Next Increment Date:</strong> {{ $rent->next_increment_date ?? 'N/A' }}</p>
                <p><strong>Rent Increment Flat:</strong> {{ $rent->increment_flat ?? 'N/A' }}</p>
                <p><strong>VAT:</strong> {{ number_format($rent->vat, 2) }}</p>
                <p><strong>Remarks:</strong> {{ $rent->remarks ?? 'N/A' }}</p>
                <p><strong>Printed:</strong> {{ \Carbon\Carbon::now()->format('d-m-Y, h:i:s a') }}
                </p>
            </div>
        </div>




        <!-- Ledger Table -->
        <div class="table-responsive" style="padding: 1em;">
            <table class="table table-bordered w-100" id="dt-responsive">
                <thead>
                    <tr>
                        <th>SL</th>
                        <th>Date & Time</th>
                        <th>Invoice</th>
                        <th>Month</th>
                        <th>Year</th>
                        <th>Payable</th>
                        <th>Payment</th>
                        <th>Balance</th>
                    </tr>
                </thead>
                <tbody>
                    @php $totalBalance = 0; @endphp
                    @foreach ($ledger as $entry)
                        @php $totalBalance += $entry->balance; @endphp
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $entry->payment_date }}</td>
                            <td>{{ $entry->id }}</td>
                            <td>
                                {{ \Carbon\Carbon::create()->month($entry->monthlyRent->month)->format('F') }}
                            </td>

                            <td>{{ $entry->monthlyRent->year }}</td>
                            <td>
                                @if ($entry->payable_amount == null)
                                    {{ number_format(0, 2) }}
                                @else
                                    {{ number_format($entry->payable_amount, 2) }}
                                @endif
                            </td>
                            <td>{{ number_format($entry->amount_paid, 2) }}</td>
                            <td>{{ number_format($entry->balance, 2) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <script>
        window.print();
    </script>
</body>

</html>
