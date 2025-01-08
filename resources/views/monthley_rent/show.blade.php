@extends('admin.masterAdmin')
@section('css')
    <style>
        /* .invoice-container {
                                                                                                                                                                                    background: #f8f9fa;
                                                                                                                                                                                    border-radius: 10px;
                                                                                                                                                                                    padding: 30px;
                                                                                                                                                                                    margin: 20px auto;
                                                                                                                                                                                    max-width: 900px;
                                                                                                                                                                                } */


        .invoice-title {
            font-weight: bold;
            font-size: 1.5rem;
        }

        .rupnagar-title {
            color: #e74c3c;
            font-weight: bold;
            font-size: 1.5rem;
        }

        .invoice-info th,
        .invoice-info td {
            text-align: left;
        }

        .invoice-info td {
            font-weight: bold;
        }

        .table {
            margin-top: 20px;
        }
    </style>
@endsection

@section('content')
    <div class="card">
        <div class="container invoice-container">
            <div class="row mt-4">
                <div class="col-6">
                    <h3 class="invoice-title">INVOICE</h3>
                </div>
                <div class="col-6 text-end">
                    <h3 class="rupnagar-title">{{ $rent->rent->house->house_name }}</h3>
                    <p> House # {{ $rent->rent->house->holding_number }} , Road #
                        {{ $rent->rent->house->address }}</p>
                    <p>Phone: {{ $rent->rent->house->contract_number }}</p>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-6">
                    <h6 class="text-primary">INVOICE TO</h6>
                    <p><strong>{{ $rent->rent->renter->name }}</strong></p>
                    <p> House # {{ $rent->rent->house->holding_number }} , Road #
                        {{ $rent->rent->house->address }}</p>
                    <p>Phone: {{ $rent->rent->renter->phone }}</p>
                    <p>Email: {{ $rent->rent->renter->email ?? 'N/A' }} </p>
                </div>
                <div class="col-6 text-end">
                    <h6 class="text-dark">INVOICE INFO</h6>
                    <p><strong>Invoice No.: </strong> {{ $rent->id }}</p>
                </div>
            </div>
            <table class="table table-bordered">
                <thead class="table-light">
                    <tr>
                        <th>Floor</th>
                        <th>Unit</th>
                        <th>Month</th>
                        <th>Year</th>
                        <th>Rent</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{ $rent->rent->floor->name }}</td>
                        <td>{{ $rent->rent->unit->name }}</td>
                        {{-- <td>{{ date('M', $rent->month) }}</td> --}}
                        <td>{{ date('F', mktime(0, 0, 0, $rent->month, 1)) }}</td>
                        <td>{{ $rent->year }}</td>
                        <td>{{ $rent->total_amount }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection
