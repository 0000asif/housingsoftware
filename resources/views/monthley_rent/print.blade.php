<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rent Collection Receipt</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body style="font-size: small">
    <div class="container my-5 border p-4">
        <h4 class="text-center">Rent Collection Receipt </h4>
        {{-- <p class="text-center"><strong>(Evictable Tenant)</strong></p> --}}
        <p class="text-center"><strong>House Name: </strong>{{ $rent->rent->house->house_name }} </p>

        <div class="row">
            <div class="col-md-6">
                <p><strong>Customer's Name:</strong> {{ $rent->rent->renter->name }}</p>
                <p><strong>Address:</strong> House # {{ $rent->rent->house->holding_number }} , Road #
                    {{ $rent->rent->house->address }}</p>
                <p><strong>Floor:</strong> {{ $rent->rent->floor->name }} Unit - {{ $rent->rent->unit->name }} ,
                    {{ date('F', mktime(0, 0, 0, $rent->month, 1)) }}
                    -{{ $rent->year }}
                </p>
            </div>
            <div class="col-md-6 text-end">
                <p><strong>Date:</strong> {{ date('d-M-Y', strtotime($rent->date)) }}
                </p>
                <p><strong>Receipt No:</strong> {{ $rent->id }}</p>
            </div>
        </div>



        <table class="table table-bordered mt-3">
            <thead class="table-light">
                <tr>
                    <th>No</th>
                    <th>Description</th>
                    <th>Amount</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>Flat/Institution/Shop Rent</td>
                    <td>{{ $rent->rent->monthly_rent }}</td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>Gas</td>
                    <td>{{ $rent->rent->gas_bill ?? 0 }}</td>
                </tr>
                <tr>
                    <td>3</td>
                    <td>Water</td>
                    <td>{{ $rent->rent->water_bill ?? 0 }}</td>
                </tr>
                <tr>
                    <td>4</td>
                    <td>Electricity</td>
                    <td>{{ $rent->rent->electracity_bill ?? 0 }}</td>
                </tr>
                <tr>
                    <td>5</td>
                    <td>Service Charge</td>
                    <td>{{ $rent->rent->service_charge ?? 0 }}</td>
                </tr>
                <tr>
                    <td>6</td>
                    <td>Gatman bill</td>
                    <td>{{ $rent->rent->gatmanbill ?? 0 }}</td>
                </tr>
                <tr>
                    <td>7</td>
                    <td>Lift Bill</td>
                    <td>{{ $rent->rent->lift_bill ?? 0 }}</td>
                </tr>
                <tr>
                    <td>8</td>
                    <td>Garage Bill</td>
                    <td>{{ $rent->rent->garage_bill ?? 0 }}</td>
                </tr>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="2" class="text-end"><strong>Total:</strong></td>
                    <td>{{ $rent->total_amount }}</td>
                </tr>
            </tfoot>
        </table>

        {{-- <p><strong>In-word:</strong> Fifteen Thousand Taka Only</p> --}}

        <div class="row mt-8" style="margin-top: 75px;">
            <div class="col-md-9">
                <p><strong>Signature of Rent Collector:</strong></p>
            </div>
            <div class="col-md-3">
                <p><strong>Date:</strong></p>
            </div>
        </div>

        <p class="text-center mt-5 text-muted"><em>"Please pay the rent for each month by the 7th of that month."</em>
        </p>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        window.print();
    </script>
</body>

</html>
