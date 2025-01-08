@extends('admin.masterAdmin')
@section('content')
    <div>
        <div class="card">
            <div class="card-header">
                <h5 class="box-title">All Pending Rent</h5>
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
                                <th>House</th>
                                <th>Floor</th>
                                <th>Unit</th>
                                <th>Name</th>
                                <th>Year</th>
                                <th>Month</th>
                                <th>Amount</th>
                                <th>Actions</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($monthlyRents as $key => $value)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ date('d-M-Y', strtotime($value->created_at)) }}</td>
                                    <td>{{ $value->id }}</td>
                                    <td>{{ $value->rent->house->house_name }}</td>
                                    <td>{{ $value->rent->floor->name }}</td>
                                    <td>{{ $value->rent->unit->name }}</td>
                                    <td>{{ $value->rent->renter->name }} -
                                        {{ $value->rent->renter->phone }}</td>

                                    <td>{{ $value->year }}</td>
                                    <td>{{ date('F', mktime(0, 0, 0, $value->month, 1)) }}</td>
                                    <td>{{ $value->total_amount }}</td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="{{ route('singleRentCollection.show', $value->id) }}"
                                                class="btn text-white btn-sm btn-primary">
                                                <i class="fa fa-eye"></i>
                                            </a>
                                            <a href="{{ route('singleRentCollection.print', $value->id) }}"
                                                class="btn text-white btn-sm btn-success">
                                                <i class="fa fa-print"></i>
                                            </a>
                                            <form action="{{ route('singleRentCollection.destroy', $value->id) }}"
                                                method="POST" id="delete-form-{{ $value->id }}">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" class="btn btn-danger btn-sm"
                                                    onclick="confirmDelete({{ $value->id }})"><i
                                                        class="fa fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
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
