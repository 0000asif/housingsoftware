@extends('admin.masterAdmin')
@section('content')
    @include('category.update')
    <!-- BEGIN: Page content-->
    <div>
        <div class="card">
            <div class="card-header">
                <h5 class="box-title">All Category</h5>
                <a data-toggle="modal" data-target="#exampleModal" class="btn btn-success btn-sm">Add new</a>
            </div>

            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <form action="" method="post" id="category_form">
                    @csrf
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Create</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">

                                <div class="form-group">
                                    <label for="name">Category</label>
                                    <select name="category_id" id="category_id" class="form-control">
                                        <option value="">Select an Option</option>
                                        @foreach ($category as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                    <span id="nameError" class="text-danger"></span>
                                </div>

                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" class="form-control" placeholder="Enter Category name"
                                        name="name" id="name">
                                    <span id="nameError" class="text-danger"></span>
                                </div>

                                <div class="form-group">
                                    <label for="address">Address</label>
                                    <input type="text" class="form-control" placeholder="Enter Category name"
                                        name="name" id="name">
                                    <span id="nameError" class="text-danger"></span>
                                </div>

                                <div class="form-group">
                                    <label for="name">Phone Number</label>
                                    <input type="text" class="form-control" placeholder="Enter Category name"
                                        name="Phone" id="name">
                                    <span id="nameError" class="text-danger"></span>
                                </div>

                                <div class="form-group">
                                    <label for="status">Status</label>
                                    <select name="status" id="status" class="form-control">
                                        <option value="1">Active</option>
                                        <option value="0">InActive</option>
                                    </select>
                                    <span id="statusError" class="text-danger"></span>
                                </div>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary add_category">Create</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="card-body">
                <br>
                @include('components/alert')
                <div class="table-responsive">
                    <table class="table table-bordered w-100" id="dt-responsive">

                        <thead class="thead-light">
                            <tr>
                                <th>SL</th>
                                <th>Added By</th>
                                <th>Categoty Name</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            {{-- @foreach ($category as $key => $value)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $value->user->name }}</td>
                                    <td>{{ $value->name }}</td>
                                    <td>
                                        @if ($value->status == '1')
                                            <span class="badge badge-success">Active</span>
                                        @else
                                            <span class="badge badge-danger">Inactive</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a data-toggle="modal" data-target="#update" data-id="{{ $value->id }}"
                                            data-name="{{ $value->name }}" data-status="{{ $value->status }}"
                                            href="" class="btn btn-sm btn-success update_form"><i
                                                class="fa fa-edit"></i>
                                        </a>
                                        <a href="javascript:void(0);" data-id="{{ $value->id }}"
                                            class="btn btn-sm btn-danger delete_category">
                                            <i class="fa fa-trash"></i>
                                        </a>

                                    </td>
                                </tr>
                            @endforeach --}}
                        </tbody>

                    </table>
                </div>
            </div>
        </div>

    </div>
    <!-- END: Page content-->
@endsection
@section('script')
    <script>
        $(document).ready(function() {
            $(document).on('click', '.add_category', function(e) {
                e.preventDefault();
                let name = $('#name').val();
                let status = $('#status').val();
                $.ajax({
                    url: "{{ Route('category.store') }}",
                    method: 'post',
                    data: {
                        name: name,
                        status: status
                    },
                    success: function(res) {
                        if (res) {
                            $('#exampleModal').modal('hide');
                            $('#category_form')[0].reset();
                            $('#nameError').html('');
                            $('#statusError').html('');
                            $('#name').val('');
                            $('.table').load(location.href + ' .table');
                            Command: toastr["success"](
                                "Category Created"
                            )

                            toastr.options = {
                                "closeButton": false,
                                "debug": false,
                                "newestOnTop": false,
                                "progressBar": false,
                                "positionClass": "toast-top-right",
                                "preventDuplicates": false,
                                "onclick": null,
                                "showDuration": "300",
                                "hideDuration": "1000",
                                "timeOut": "5000",
                                "extendedTimeOut": "1000",
                                "showEasing": "swing",
                                "hideEasing": "linear",
                                "showMethod": "fadeIn",
                                "hideMethod": "fadeOut"
                            }
                        }
                    },
                    error: function(err) {
                        if (err) {
                            $('#nameError').html(err.responseJSON.errors.name);
                            $('#statusError').html(err.responseJSON.errors.status);
                        }
                    },
                })

            });

            //update category
            $(document).on('click', '.update_form', function() {

                let id = $(this).data('id');
                let name = $(this).data('name');
                let status = $(this).data('status');
                $('#up_id').val(id);
                $('#up_name').val(name);
                $('#up_status').val(status);

                $(document).on('click', '.update_category', function(e) {
                    e.preventDefault();
                    let id = $('#up_id').val();
                    let name = $('#up_name').val();
                    let status = $('#up_status').val();
                    $.ajax({
                        url: "{{ Route('update.category') }}",
                        method: 'post',
                        data: {
                            id: id,
                            name: name,
                            status: status
                        },
                        success: function(res) {
                            if (res) {
                                $('#update').modal('hide');
                                $('#category_form')[0].reset();
                                $('.table').load(location.href + ' .table');
                            }
                            Swal.fire(
                                'Success!',
                                res.message,
                                'success'
                            );
                        },
                        error: function(err) {
                            if (err) {
                                $('#nameError').html(err.responseJSON.errors.name);
                                $('#statusError').html(err.responseJSON.errors.status);
                            }

                        },
                    });
                });
            });


            //delete category

            $(document).on('click', '.delete_category', function(e) {
                e.preventDefault();
                let id = $(this).data('id');

                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: "{{ route('delete.category') }}",
                            method: 'POST',
                            data: {
                                id: id,
                                _token: "{{ csrf_token() }}" // Include CSRF token for security
                            },
                            success: function(res) {
                                if (res.success) {
                                    Swal.fire(
                                        'Deleted!',
                                        res.message,
                                        'success'
                                    );
                                    // Reload part of the table dynamically
                                    $('.table').load(location.href + ' .table');
                                } else {
                                    Swal.fire(
                                        'Error!',
                                        res.message,
                                        'error'
                                    );
                                }
                            },
                            error: function() {
                                Swal.fire(
                                    'Error!',
                                    'Something went wrong.',
                                    'error'
                                );
                            }
                        });
                    }
                });
            });


        });
    </script>
@endsection
