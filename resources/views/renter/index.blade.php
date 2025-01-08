@extends('admin.masterAdmin')
@section('content')
    <div>
        <div class="card">
            <div class="card-header">
                <h5 class="box-title">ভাড়াটিয়ার তালিকা </h5>
                <a href="{{ route('renter.create') }}" class="btn btn-success btn-sm">ভাড়াটিয়া যুক্ত করুন</a>
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
                                <th>Name</th>
                                <th>Contact Number</th>
                                <th>NID</th>
                                <th>Gender</th>
                                <th>Occuption</th>
                                <th>address</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($renters as $key => $value)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ date('d-M-Y', strtotime($value->created_at)) }}</td>
                                    <td>{{ $value->name }}</td>
                                    <td>{{ $value->phone ?? 'N/A' }}</td>
                                    <td>{{ $value->nid ?? 'N/A' }}</td>
                                    <td>{{ $value->gender ?? 'N/A' }}</td>
                                    <td>{{ $value->occupation ?? 'N/A' }}</td>
                                    <td>{{ $value->address ?? 'N/A' }}</td>
                                    <td>
                                        @if ($value->status == '1')
                                            <span class="badge badge-success">Active</span>
                                        @else
                                            <span class="badge badge-danger">Inactive</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="{{ route('renter.show', $value->id) }}"
                                                class="btn text-white btn-sm btn-primary">
                                                <i class="fa fa-eye"></i>
                                            </a>
                                            <a href="{{ route('renter.edit', $value->id) }}"
                                                class="btn text-white btn-sm btn-warning">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            <form action="{{ route('renter.destroy', $value->id) }}" method="POST"
                                                id="delete-form-{{ $value->id }}">
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
