<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Money Receipt</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5 border p-4">
        <div class="text-center">

            {{-- <td>{{ $value->monthly_rent->rent->renter->name }}</td>
            <td>{{ $value->monthly_rent->rent->renter->phone }}</td>
            <td>{{ $value->monthly_rent->rent->house->house_name }}</td> --}}
            <h5><strong>{{ $history->monthly_rent->rent->house->house_name }}</strong></h5>
            <p>{{ $history->monthly_rent->rent->house->address }}</p>
            <p>Cell: {{ $history->monthly_rent->rent->house->contract_number }}</p>
        </div>

        <div class="d-flex justify-content-between align-items-center mt-4">
            <h6><strong>INVOICE NO:</strong> #{{ $history->invoice }}</h6>
            <h6><strong>MONEY RECEIPT</strong></h6>
            <h6><strong>Printed On:</strong> {{ now() }}</h6>
        </div>

        <div class="mt-3">
            <p><strong>Name:</strong> {{ $history->monthly_rent->rent->renter->name }}</p>
            <p><strong>Mobile:</strong> {{ $history->monthly_rent->rent->renter->phone }}</p>
            <p><strong>Collect Date:</strong> {{ $history->payment_date }}</p>
            <p><strong>Payment Method:</strong> {{ $history->payment_method }}</p>
            <p><strong>Collection For :</strong>
                {{ date('F', mktime(0, 0, 0, $history->month, 1)) }}
                -{{ $history->year }}</p>
        </div>

        <hr>

        <div class="mt-3">
            <h6><strong>Collection Information</strong></h6>
            <p><strong>Received Amount:</strong> Tk. {{ $history->amount_paid }}</p>
            {{-- <p><strong>In Word:</strong> Thirteen Thousand Five Hundred Taka Only.</p> --}}
            <p><strong>Due Amount:</strong> Tk. {{ $due }}</p>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        window.print();
    </script>
</body>

</html>
