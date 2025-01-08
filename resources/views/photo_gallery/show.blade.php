@extends('admin.masterAdmin')
@section('content')
    <!-- BEGIN: Page content-->
    <div>
        <div class="row">
            <div class="col-12 col-sm-12 col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h4 class="box-title">Renter INfo Details</h4>
                        <a href="{{ route('renter.index') }}" class="btn btn-success btn-sm">Back</a>
                    </div>
                    <div class="card-body">
                        @include('components/alert')

                        <h4>Basic Information</h4>
                        <p><strong>Name:</strong> {{ $renter->name }}</p>
                        <p><strong>Email:</strong> {{ $renter->email ?? 'N/A' }}</p>
                        <p><strong>Phone:</strong> {{ $renter->phone }}</p>
                        <p><strong>NID:</strong> {{ $renter->nid }}</p>

                        <h4>Additional Information</h4>
                        <p><strong>Gender:</strong> {{ ucfirst($renter->gender) }}</p>
                        <p><strong>Date of Birth:</strong>
                            {{ $renter->birth_date ?? 'N/A' }}</p>
                        <p><strong>Birth Registration Number:</strong> {{ $renter->regnumber ?? 'N/A' }}</p>
                        <p><strong>Occupation:</strong> {{ $renter->occupation }}</p>
                        <p><strong>Institute Name:</strong> {{ $renter->institute ?? 'N/A' }}</p>
                        <p><strong>Other Info:</strong> {{ $renter->other_info ?? 'N/A' }}</p>

                        <h4>Address</h4>
                        <p><strong>Permanent Address:</strong> {{ $renter->address }}</p>
                        <p><strong>Status:</strong>
                            @if ($renter->status == 0)
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
    <!-- END: Page content-->
@endsection
