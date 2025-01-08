@extends('admin.masterAdmin')
@section('content')
    <div>
        <div class="card">
            <div class="card-header">
                <h5 class="box-title">Rent Collection History</h5>
            </div>
            <div class="card-body">
                <br>
                @include('components/alert')
                <div class="table-responsive">
                    <table class="table table-bordered w-100" id="dt-responsive">

                        <thead class="thead-light">
                            <tr>
                                <th>SL</th>
                                <th>Created Date</th>
                                <th>Invoice</th>
                                <th>Name</th>
                                <th>Mobile</th>
                                <th>House</th>
                                <th>Collection Amount</th>
                                <th>Remarks</th>
                                <th>Actions</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($history as $key => $value)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ date('d-M-Y', strtotime($value->created_at)) }}</td>
                                    <td>{{ $value->invoice }}</td>
                                    <td>{{ $value->monthly_rent->rent->renter->name }}</td>
                                    <td>{{ $value->monthly_rent->rent->renter->phone }}</td>
                                    <td>{{ $value->monthly_rent->rent->house->house_name }}</td>
                                    <td>{{ $value->amount_paid }}</td>
                                    <td>{{ $value->notes }}</td>
                                    <td>
                                        <a href="{{ route('colletion.print', $value->id) }}"
                                            class="btn text-white btn-sm btn-success">
                                            <i class="fa fa-print"></i></a>
                                        <form action="{{ route('rentcollection.delete', $value->id) }}" method="POST"
                                            id="delete-form-{{ $value->id }}" style="display:inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="btn btn-danger btn-sm"
                                                onclick="confirmDelete({{ $value->id }})"><i class="fa fa-trash"></i>
                                            </button>
                                        </form>
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
