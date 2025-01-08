@extends('admin.masterAdmin')

@section('content')
    @include('category.update')
    <!-- BEGIN: Page content-->
    <div>
        <div class="card">
            <div class="card-header">
                <h5 class="box-title">Add video</h5>
                <a href="{{ route('video_gallery.index') }}" class="btn btn-success btn-sm">Back</a>
            </div>
            <div class="card-body">
                <br>
                @include('components/alert')
                <form action="{{ route('video_gallery.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" name="title" id="title" class="form-control" value="{{ old('title') }}"
                            required>
                        @error('title')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="video" class="form-label">video</label>
                        <input type="url" name="video" id="video" class="form-control" required>
                        @error('video')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select name="status" id="status" class="form-control">
                            <option value="1" selected>Active</option>
                            <option value="0">Inactive</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary">Save</button>
                    <a href="{{ route('video_gallery.index') }}" class="btn btn-secondary">Cancel</a>
                </form>
            </div>
        </div>

    </div>
    <!-- END: Page content-->
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },

            });
        });

        $(document).ready(function() {
            $(document).on('change', '#house_id', function() {
                let houseId = $(this).val();

                if (houseId) {
                    $.ajax({
                        url: "{{ route('get.floors', ':houseId') }}".replace(':houseId',
                            houseId),
                        method: 'GET',
                        success: function(data) {
                            let floorSelect = $(
                                'select[name="floor_id"]');
                            floorSelect.empty();
                            floorSelect.append(
                                '<option value="">Select an option</option>');

                            // Populate floor options
                            data.forEach(function(floor) {
                                floorSelect.append(
                                    `<option value="${floor.id}">${floor.name}</option>`
                                );
                            });
                        },
                        error: function(err) {
                            console.error(err.responseText);
                        }
                    });
                } else {
                    $('select[name="floor_id"]').html('<option value="">Select an option</option>');
                }
            });

        });
    </script>
@endsection
