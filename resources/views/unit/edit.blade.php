@extends('admin.masterAdmin')
@section('content')
    <!-- BEGIN: Page content-->
    <div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card card-fullheight">
                    <div class="card-header">
                        <h5 class="box-title">Edit Unit/Room</h5>
                        <a href="{{ route('unit.index') }}" class="btn btn-success btn-sm">Back</a>
                    </div>
                    <div class="card-body">
                        @include('components/alert')

                        {!! Form::open(['route' => ['unit.update', $info->id], 'method' => 'put', 'files' => true]) !!}
                        <div class="row">

                            <div class="col-12 col-md-6 col-lg-6">
                                <div class="form-group mb-4">
                                    <label>Select Status<span style="color: red;">*</span></label>
                                    <select class="form-control select2_demo" name="status" required>
                                        <option value="">Select an option</option>
                                        <option value="0" {{ $info->status == 0 ? 'selected' : '' }}>InActive
                                        </option>
                                        <option value="1" {{ $info->status == 1 ? 'selected' : '' }}>Active
                                        </option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-12 col-md-6 col-lg-6">
                                <div class="form-group mb-4">
                                    <label>Select House<span style="color: red;">*</span></label>
                                    <select class="form-control select2_demo" name="house_id" id="house_id" required>
                                        <option value="">Select an option</option>
                                        @foreach ($house as $item)
                                            <option value="{{ $item->id }}" data-value="{{ $item->id }}"
                                                {{ $info->house_id == $item->id ? 'selected' : '' }}>
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
                                    <select class="form-control select2_demo" name="floor_id" id="floor_id" required>
                                        <option value="">Select an option</option>
                                        <!-- Options will be populated dynamically -->
                                    </select>
                                </div>
                            </div>



                            <div class="col-12 col-md-6 col-lg-6">
                                <div class="form-group mb-4">
                                    <label for="owner_name">Unit/Room Name<span style="color: red;">*</span></label>
                                    <input type="text" name="name" value="{{ $info->name }}" id=""
                                        class="form-control" placeholder="Unit/Room Name">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group mb-4">
                                    <label for="contract_number">Unit/Room INfo</label>
                                    <input type="text" name="info" value="{{ $info->info }}" id=""
                                        class="form-control" placeholder="Unit/Room INfo">
                                </div>
                            </div>

                        </div>

                        <div class="form-group"><button class="btn btn-primary mr-2" type="submit"
                                id="collection_button">Submit</button></div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div><!-- END: Page content-->
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
            // Fetch floors on page load if editing
            let selectedHouseId = $('#house_id').val(); // Get the pre-selected house ID
            let selectedFloorId = "{{ $info->floor_id ?? '' }}"; // Get the pre-selected floor ID

            if (selectedHouseId) {
                fetchFloors(selectedHouseId, selectedFloorId); // Fetch floors for the selected house
            }

            // Fetch floors on house selection change
            $(document).on('change', '#house_id', function() {
                let houseId = $(this).val();
                fetchFloors(houseId); // Fetch floors for the new house
            });

            function fetchFloors(houseId, preselectedFloorId = null) {
                if (houseId) {
                    $.ajax({
                        url: "{{ route('get.floors', ':houseId') }}".replace(':houseId', houseId),
                        method: 'GET',
                        success: function(data) {
                            let floorSelect = $('#floor_id'); // Target the floor dropdown
                            floorSelect.empty(); // Clear existing options
                            floorSelect.append(
                                '<option value="">Select an option</option>'); // Default option

                            // Populate floor options
                            data.forEach(function(floor) {
                                floorSelect.append(
                                    `<option value="${floor.id}" ${
                                preselectedFloorId == floor.id ? 'selected' : ''
                            }>${floor.name}</option>`
                                );
                            });
                        },
                        error: function(err) {
                            console.error(err.responseText);
                        },
                    });
                } else {
                    $('#floor_id').html('<option value="">Select an option</option>'); // Reset if no house selected
                }
            }
        });
    </script>
@endsection
