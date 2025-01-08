@extends('admin.masterAdmin')
@section('content')
    <div>
        <div class="card">
            <div class="card-header">
                <h5 class="box-title">All Note List</h5>
                <a href="{{ route('remainder.create') }}" class="btn btn-success btn-sm">Add new</a>
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
                                <th>Renter</th>
                                <th>Remainder Date</th>
                                <th>Note</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($data as $key => $value)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ date('d-M-Y', strtotime($value->created_at)) }}</td>
                                    <td>{{ $value->renter->name ?? 'N/A' }}</td>
                                    <td>{{ date('d-M-Y', strtotime($value->date)) }}</td>
                                    <td>{{ $value->note ?? 'N/A' }}</td>
                                    <td>
                                        @if ($value->status == '2')
                                            <span class="badge badge-success">Complete</span>
                                        @elseif ($value->status == '1')
                                            <span class="badge badge-warning">In process</span>
                                        @else
                                            <span class="badge badge-danger">Cancle</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('remainder.edit', $value->id) }}"
                                            class="btn text-white btn-sm btn-primary">
                                            <i class="fa fa-edit"></i></a>
                                        <form action="{{ route('remainder.destroy', $value->id) }}" method="POST"
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
