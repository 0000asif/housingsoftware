@extends('admin.masterAdmin')
@section('content')
    <div>
        <div class="card">
            <div class="card-header">
                <h5 class="box-title">All Photo List</h5>
                <a href="{{ route('photo_gallery.create') }}" class="btn btn-success btn-sm">Add new</a>
            </div>
            <div class="card-body">
                <br>
                @include('components/alert')
                <div class="table-responsive">
                    <table class="table table-bordered w-100" id="dt-responsive">

                        <thead class="thead-light">
                            <tr>
                                <th>Title</th>
                                <th>Photo</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($photos as $photo)
                                <tr>
                                    <td>{{ $photo->title }}</td>
                                    <td>
                                        <img src="{{ asset('image/photoGalery/' . $photo->photo) }}" width="100"
                                            alt="Photo">
                                    </td>
                                    <td>
                                        @if ($photo->status == 0)
                                            <span class="badge badge-danger">In Active</span>
                                        @elseif ($photo->status == 1)
                                            <span class="badge badge-primary">Active</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="btn btn-group" role="group">
                                            <a href="{{ route('photo_gallery.edit', $photo->id) }}"
                                                class="btn btn-primary btn-sm"> <i class="fa fa-edit"></i></a>
                                            <form action="{{ route('photo_gallery.destroy', $photo->id) }}" method="POST"
                                                id="delete-form-{{ $photo->id }}">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" class="btn btn-danger btn-sm"
                                                    onclick="confirmDelete({{ $photo->id }})"><i class="fa fa-trash"></i>
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
