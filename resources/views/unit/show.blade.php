@extends('admin.masterAdmin')
@section('content')
    <!-- BEGIN: Page content-->
    <div>
        <div class="row">
            <div class="col-12 col-sm-12 col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h5 class="box-title">House Details</h5>
                        <a href="{{ route('house.index') }}" class="btn btn-success btn-sm">Back</a>
                    </div>
                    <div class="card-body">
                        @include('components/alert')
                        <div class="table-responsive">
                            <table class="table table-bordered w-100">
                                <tbody>

                                    <tr>
                                        <th>Created By</th>
                                        <td>{{ $info->user->name }}</td>
                                    </tr>
                                    <tr>
                                        <th>Created date</th>
                                        <td>{{ date('d-M-Y', strtotime($info->created_at)) }}</td>
                                    </tr>

                                    <tr>
                                        <th>House Name</th>
                                        <td>{{ $info->house_name ?? 'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Ownner Name</th>
                                        <td>{{ $info->owner_name ?? 'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Contract Number</th>
                                        <td>{{ $info->contract_number ?? 'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Holding Number</th>
                                        <td>{{ $info->holding_number ?? 'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Address</th>
                                        <td>{{ $info->address }}</td>
                                    </tr>
                                    <tr>
                                        <th>Land Info</th>
                                        <td>{{ $info->land_info }}</td>
                                    </tr>
                                    <tr>
                                        <th>Opening Balance</th>
                                        <td>{{ $info->opening_balance }}</td>
                                    </tr>
                                    <tr>
                                        <th>Project Document File</th>
                                        <td>
                                            @if ($info->document)
                                                <a href="{{ asset('public/images/house/' . $info->document) }}"
                                                    download="" class="btn btn-success btn-sm">Download</a>
                                            @else
                                                {{ 'N/A' }}
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Status</th>
                                        <td>
                                            @if ($info->status == 0)
                                                <span class="badge badge-danger">InActive</span>
                                            @else
                                                <span class="badge badge-success">Active</span>
                                            @endif
                                        </td>
                                    </tr>
                                </tbody>



                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>



    </div>
    <!-- END: Page content-->
@endsection
