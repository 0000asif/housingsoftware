@extends('admin.masterAdmin')
@section('content')
    <div>
        <div class="card">
            <div class="card-header">
                <h5 class="box-title">Agreement Ledger</h5>
            </div>
            <div class="card-body">
                <br>
                @include('components/alert')
                <div class="table-responsive">
                    <table class="table table-bordered w-100" id="dt-responsive">

                        <thead class="thead-light">
                            <tr>
                                <th>SL</th>
                                <th>Renter Name</th>
                                <th>Mobile</th>
                                <th>Rent </th>
                                <th>Agreement Date</th>
                                <th>Notes</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($ledgers as $ledger)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $ledger->rent->renter->name ?? 'N/A' }}</td>
                                    <td>{{ $ledger->rent->renter->phone ?? 'N/A' }}</td>
                                    <td>{{ $ledger->monthlyRent->total_amount ?? 'N/A' }}</td>
                                    <td>{{ date('d M Y', strtotime($ledger->rent->rent_date)) ?? 'N/A' }}</td>
                                    <td>{{ $ledger->notes ?? 'N/A' }}</td>
                                    <td>
                                        <a href="{{ route('renter.ledger.show', $ledger->monthly_rent_id) }}"
                                            class="btn btn-info">Full Ledger</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>

                    </table>
                </div>
            </div>
        </div>

    </div>
    <!-- END: Page content-->
@endsection
