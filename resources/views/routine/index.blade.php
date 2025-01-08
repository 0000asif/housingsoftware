@extends('admin.masterAdmin')
@section('content')
    <div>
        <div class="card">
            <div class="card-header">
                <h5 class="box-title">All Routine List</h5>
                <a href="{{ route('routine.create') }}" class="btn btn-success btn-sm">Add new</a>
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
                                <th>Title</th>
                                <th>Batch</th>
                                <th>File</th>
                                <th>Description</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($routines as $key => $value)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ date('d-M-Y', strtotime($value->created_at)) }}</td>
                                    <td>{{ $value->title }}</td>
                                    <td>{{ $value->batch->name ?? 'N/A' }}</td>
                                    <td>{{ $value->file ?? 'N/A' }}
                                        <a href="{{ asset('public/image/routine/' . $value->file) }}" download=""
                                            class="btn btn-success btn-sm">Download</a>
                                    </td>
                                    <td>{{ $value->description ?? 'N/A' }}</td>
                                    <td>
                                        @if ($value->status == '1')
                                            <span class="badge badge-success">Active</span>
                                        @else
                                            <span class="badge badge-danger">Inactive</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('routine.edit', $value->id) }}"
                                            class="btn text-white btn-sm btn-primary">
                                            <i class="fa fa-edit"></i></a>
                                        <form action="{{ route('routine.destroy', $value->id) }}" method="POST"
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
