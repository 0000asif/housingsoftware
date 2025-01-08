@extends('admin.masterAdmin')
@section('content')
    <div>
        <div class="card">
            <div class="card-header">
                <h5 class="box-title">All Rent List</h5>
                <a href="{{ route('rent.create') }}" class="btn btn-success btn-sm">Add new</a>
            </div>
            <div class="card-body">
                <br>
                @include('components/alert')
                <div class="table-responsive">
                    <table class="table table-bordered w-100" id="dt-responsive">
                        <thead class="thead-light">
                            <tr>
                                <th>SL</th>
                                <th>Renter</th>
                                <th>House</th>
                                <th>Floor</th>
                                <th>Unit</th>
                                <th>Rent Date</th>
                                <th>Monthly Rent</th>
                                <th>Actions</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($rents as $key => $rent)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $rent->renter->name }} ({{ $rent->renter->phone }})</td>
                                    <td>{{ $rent->house->house_name }}</td>
                                    <td>{{ $rent->floor->name }}</td>
                                    <td>{{ $rent->unit->name }}</td>
                                    <td>{{ $rent->rent_date }}</td>
                                    <td>{{ $rent->monthly_rent }}</td>
                                    <td>
                                        <a href="{{ route('rent.show', $rent->id) }}"
                                            class="btn text-white btn-sm btn-success">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                        <a href="{{ route('rent.edit', $rent->id) }}"
                                            class="btn text-white btn-sm btn-primary">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        <form action="{{ route('rent.destroy', $rent->id) }}" method="POST"
                                            id="delete-form-{{ $rent->id }}" style="display:inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="btn btn-danger btn-sm"
                                                onclick="confirmDelete({{ $rent->id }})"><i class="fa fa-trash"></i>
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
