@extends('admin.masterAdmin')
@section('content')
    <div>
        <div class="card">
            <div class="card-header">
                <h5 class="box-title">All Video List</h5>
                <a href="{{ route('video_gallery.create') }}" class="btn btn-success btn-sm">Add new</a>
            </div>
            <div class="card-body">
                <br>
                @include('components/alert')
                <div class="table-responsive">
                    <table class="table table-bordered w-100" id="dt-responsive">

                        <thead class="thead-light">
                            <tr>
                                <th>Title</th>
                                <th>video</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($videos as $video)
                                <tr>
                                    <td>{{ $video->title }}</td>
                                    <td>
                                        {{ $video->video }}
                                    </td>
                                    <td>
                                        @if ($video->status == 0)
                                            <span class="badge badge-danger">In Active</span>
                                        @elseif ($video->status == 1)
                                            <span class="badge badge-primary">Active</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="btn btn-group" role="group">
                                            <a href="{{ route('video_gallery.edit', $video->id) }}"
                                                class="btn btn-primary btn-sm"> <i class="fa fa-edit"></i></a>
                                            <form action="{{ route('video_gallery.destroy', $video->id) }}" method="POST"
                                                id="delete-form-{{ $video->id }}">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" class="btn btn-danger btn-sm"
                                                    onclick="confirmDelete({{ $video->id }})"><i class="fa fa-trash"></i>
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
