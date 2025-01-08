@extends('admin.masterAdmin')
@section('content')
    @include('category.update')
    <!-- BEGIN: Page content-->
    <div>
        <div class="card">
            <div class="card-header">
                <h5 class="box-title">Add Unit/Room </h5>
                <a href="{{ route('unit.index') }}" class="btn btn-success btn-sm">Back</a>
            </div>
            <div class="card-body">
                <br>
                @include('components/alert')
                <form action="{{ route('unit.store') }}" enctype="multipart/form-data" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-12 col-md-6 col-lg-6">
                            <div class="form-group mb-4">
                                <label>Select House<span style="color: red;">*</span></label>
                                <select class="form-control select2_demo" id="house_id" name="house_id" required>
                                    <option value="">Select an option</option>
                                    @foreach ($house as $item)
                                        <option value="{{ $item->id }}" data-value="{{ $item->id }}">
                                            {{ $item->house_name }}-
                                            {{ $item->contract_number }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-12 col-md-6 col-lg-6">
                            <div class="form-group mb-4">
                                <label>Select Floor<span style="color: red;">*</span></label>
                                <select class="form-control select2_demo" name="floor_id" required>
                                    <option value="">Select an option</option>
                                </select>
                            </div>
                        </div>


                        <div class="col-12 col-md-6 col-lg-6">
                            <div class="form-group mb-4">
                                <label for="owner_name">Unit/Room Name<span style="color: red;">*</span></label>
                                <input type="text" name="name" id="" class="form-control"
                                    placeholder="Unit/Room Name">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group mb-4">
                                <label for="contract_number">Unit/Room INfo</label>
                                <input type="text" name="info" id="" class="form-control"
                                    placeholder="Unit/Room INfo">
                            </div>
                        </div>

                    </div>
                    <div class="form-group mr-2">
                        <button class="btn btn-primary" type="submit">Submit</button>
                    </div>
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
