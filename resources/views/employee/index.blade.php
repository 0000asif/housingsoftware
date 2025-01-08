@extends('admin.masterAdmin')
@section('content')
    <div>
        <div class="card">
            <div class="card-header">
                <h5 class="box-title">All Employee List</h5>
                <a href="{{ route('employee.create') }}" class="btn btn-success btn-sm">Add new</a>
            </div>
            <div class="card-body">
                <br>
                @include('components/alert')
                <div class="table-responsive">
                    <table class="table table-bordered w-100" id="dt-responsive">

                        <thead class="thead-light">
                            <tr>
                                <th>SL</th>
                                <th>Created by</th>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Contact Number</th>
                                <th>Designation</th>
                                <th>Salary</th>
                                <th>join date</th>
                                <th>Actions</th>
                            </tr>
                        </thead>

                        <tbody>



                            @foreach ($employees as $key => $value)
                                <tr>
                                    <th>{{ $key + 1 }}</th>
                                    <td>{{ $value->user->name }}</td>
                                    <td><img src="{{ asset('/admin/employee/' . $value->image) }}" alt="{{ __('image') }}"
                                            width="150px" alt="file not found"> </td>
                                    <td>{{ $value->name }} </td>
                                    <td>{{ $value->email }} </td>
                                    <td>{{ $value->phone }} </td>
                                    <td>{{ $value->designation->name }}</td>
                                    <td>{{ $value->salary }} </td>
                                    <td>{{ date('d-m-Y', strtotime($value->join_date)) }}</td>

                                    <td>
                                        <div class="btn-group">

                                            <a href="{{ route('employee.edit', $value->id) }}"
                                                class="btn btn-sm btn-warning text-white"><i class="ti-pencil-alt"></i></a>

                                            <form action="{{ route('employee.destroy', $value->id) }}" method="POST"
                                                id="delete-form-{{ $value->id }}" style="display:inline-block;">
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
