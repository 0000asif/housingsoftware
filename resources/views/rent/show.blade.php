@extends('admin.masterAdmin')
@section('content')
    <!-- BEGIN: Page content-->
    <div>
        <div class="row">
            <div class="col-12 col-sm-12 col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h5 class="box-title">Rent Details</h5>
                        <a href="{{ route('rent.index') }}" class="btn btn-success btn-sm">Back</a>
                    </div>
                    <div class="card-body">
                        @include('components/alert')
                        <div class="card-body">
                            <p><strong>Renter:</strong> {{ $rent->renter->name }} ({{ $rent->renter->phone }})</p>
                            <p><strong>House:</strong> {{ $rent->house->house_name }}</p>
                            <p><strong>Floor:</strong> {{ $rent->floor->name }}</p>
                            <p><strong>Unit:</strong> {{ $rent->unit->name }}</p>
                            <p><strong>Rent Date:</strong> {{ $rent->rent_date }}</p>
                            <p><strong>Monthly Rent:</strong> {{ $rent->monthly_rent }}</p>
                            <p><strong>Electricity Bill:</strong> {{ $rent->electracity_bill ?? 'N/A' }}</p>
                            <p><strong>Water Bill:</strong> {{ $rent->water_bill ?? 'N/A' }}</p>
                            <p><strong>Gas Bill:</strong> {{ $rent->gas_bill ?? 'N/A' }}</p>
                            <p><strong>Gateman Bill:</strong> {{ $rent->gatmanbill ?? 'N/A' }}</p>
                            <p><strong>Lift Bill:</strong> {{ $rent->lift_bill ?? 'N/A' }}</p>
                            <p><strong>Car/Bike Registration no :</strong> {{ $rent->car_reg_no ?? 'N/A' }}</p>
                            <p><strong>Car/Bike Quantity:</strong> {{ $rent->quantity ?? 'N/A' }}</p>
                            <p><strong>Garage Bill:</strong> {{ $rent->garage_bill ?? 'N/A' }}</p>
                            <p><strong>Service Charge:</strong> {{ $rent->service_charge ?? 'N/A' }}</p>
                            <p><strong>Advance Payment:</strong> {{ $rent->advance ?? 'N/A' }}</p>
                            <p><strong>Family Member:</strong> {{ number_format($rent->member) ?? 'N/A' }}</p>
                            <p><strong>Status:</strong>
                                @if ($rent->status == 0)
                                    <span class="badge badge-danger">InActive</span>
                                @else
                                    <span class="badge badge-success">Active</span>
                                @endif
                            </p>

                        </div>
                    </div>
                </div>
            </div>
        </div>



    </div>
    <!-- END: Page content-->
@endsection
