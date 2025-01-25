@extends('admin.masterAdmin')
@section('content')
    <!-- BEGIN: Page content-->
    <div>
        <div class="row">
            <div class="col-12 col-sm-12 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="box-title">Agreement Full Ledger</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <h5>Basic Info</h5>
                                <p><strong>Agreement ID:</strong> {{ $rent->id }}</p>
                                <p><strong>House Name:</strong> {{ $rent->rent->house->house_name ?? 'N/A' }}</p>
                                <p><strong>Floor:</strong> {{ $rent->rent->floor->name ?? 'N/A' }}</p>
                                <p><strong>Unit:</strong> {{ $rent->rent->unit->name ?? 'N/A' }}</p>
                                {{-- <p><strong>Advance Amount:</strong> {{ number_format($rent->advance_amount, 2) }}</p> --}}
                                <p><strong>Rent Amount:</strong> {{ number_format($rent->total_amount, 2) }}</p>
                                <p><strong>Extra Charge:</strong> {{ number_format($rent->extra_charge, 2) }}</p>
                            </div>
                            <div class="col-md-6">
                                <h5>Agreement Info</h5>
                                <p><strong>Agreement Date:</strong> {{ $rentAdjust->adjustment_date ?? '' }}</p>
                                <p><strong>Rent Increment (Months):</strong>
                                    {{ $rentAdjust && $rentAdjust->month
                                        ? \Carbon\Carbon::create()->month($rentAdjust->month)->format('F')
                                        : 'N/A' }}-{{ $rentAdjust->year ?? 'N/A' }}
                                </p>

                                <p><strong>Next Increment Date:</strong> {{ $rentAdjust->next_increment_date ?? 'N/A' }}</p>
                                <p><strong>Rent Increment Flat:</strong> {{ $rentAdjust->monthly_rent ?? 'N/A' }}</p>
                                <p><strong>Remarks:</strong> {{ $rentAdjust->remarks ?? 'N/A' }}</p>
                            </div>

                        </div>
                    </div>


                    <a href="{{ route('renter.ledger.print', $rent->id) }}" class="btn btn-primary mb-3"
                        style="width:33%; margin-left:20px;">Print
                        Ledger</a>

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
            </div>
        </div>



        <!-- END: Page content-->
    @endsection
