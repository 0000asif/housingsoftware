@extends('admin.masterAdmin')
@section('css')
    <style>
        .form-section {
            border: 1px solid #dee2e6;
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 20px;
        }

        .form-section-title {
            background-color: #e9ecef;
            padding: 10px;
            margin: -15px -15px 15px -15px;
            border-bottom: 1px solid #dee2e6;
        }

        input[type="radio"] {
            width: 1.5em;
            height: 1.5em;
        }
    </style>
@endsection


@section('content')
    @include('category.update')
    <!-- BEGIN: Page content-->
    <div>
        <div class="card">
            <div class="card-header">
                <h5 class="box-title">Add Rent</h5>
                <a href="{{ route('rent.index') }}" class="btn btn-success btn-sm">Back</a>
            </div>
            <div class="card-body">
                <br>
                @include('components/alert')
                <form action="{{ route('rent.store') }}" enctype="multipart/form-data" method="post">
                    @csrf

                    <!-- Main Renter Information -->
                    <div class="form-section">
                        <div class="form-section-title">Renter Information</div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Select Renter<span style="color: red;">*</span></label>
                                <select class="form-control select2_demo" id="renter_id" name="renter_id" required>
                                    <option value="">Select an option</option>
                                    @foreach ($renter as $item)
                                        <option value="{{ $item->id }}">
                                            {{ $item->name }}-
                                            {{ $item->phone }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="rentDate" class="form-label">Rent Date<span style="color: red;">*</span></label>
                                <input type="text" placeholder="Rent Date" required name="rent_date" id="rentDate"
                                    class="form-control datetimepicker_5">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label class="form-label">Select House<span style="color: red;">*</span></label>
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
                            <div class="col-md-4">
                                <label>Select Floor<span style="color: red;">*</span></label>
                                <select class="form-control select2_demo" id="floor_id" name="floor_id" required>
                                    <option value="">Select an option</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label>Select Unit<span style="color: red;">*</span></label>
                                <select class="form-control select2_demo" name="unit_id" required>
                                    <option value="">Select an option</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- Rent Details -->
                    <div class="form-section">
                        <div class="form-section-title">Rent Details</div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="monthlyRent" class="form-label">Monthly Rent<span
                                        style="color: red;">*</span></label>
                                <input type="number" name="monthly_rent" required id="monthlyRent" class="form-control"
                                    placeholder="0">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="electricityBill" class="form-label">Electricity Bill</label>
                                <input type="number" name="electracity_bill" id="electricityBill" class="form-control"
                                    placeholder="0">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="waterBill" class="form-label">Water Bill</label>
                                <input type="number" id="waterBill" name="water_bill" class="form-control" placeholder="0">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="gasBill" class="form-label">Gas Bill</label>
                                <input type="number" id="gasBill" name="gas_bill" class="form-control" placeholder="0">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Gatman bill</label>
                                <input type="number" id="" name="gatmanbill" class="form-control" placeholder="0">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Lift bill</label>
                                <input type="number" id="" name="lift_bill" class="form-control" placeholder="0">
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label class="form-label">Car/Bike REG NO.</label>
                                        <input type="number" id="" name="car_reg_no" class="form-control"
                                            placeholder="0">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Car/Bike Qty</label>
                                        <input type="number" id="" name="quantity" class="form-control"
                                            placeholder="0">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Garage Bill</label>
                                <input type="number" id="" name="garage_bill" class="form-control"
                                    placeholder="0">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Service Charge</label>
                                <input type="number" id="" name="service_charge" class="form-control"
                                    placeholder="0">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Advance</label>
                                <input type="number" id="" name="advance" class="form-control"
                                    placeholder="0">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Family Member</label>
                                <input type="number" id="" name="member" class="form-control"
                                    placeholder="0">
                            </div>
                        </div>

                    </div>

                    <!-- Rent Closing -->
                    {{-- <div class="form-section">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="rentClosingDate" class="form-label" style="color: red; font-weight:600;">Rent
                                    Closing Date</label>
                                <input type="text" placeholder="Rent Close Date" name="close_date"
                                    id="rentClosingDate" class="form-control datetimepicker_5">
                            </div>

                            <div class="col-md-6">
                                <div>
                                    <label for="rentClosingDate" class="form-label"
                                        style="color: green; font-weight:600;">Rent/Due Clearing</label>
                                </div>
                                <div>
                                    <div class="form-check-inline  me-4">
                                        <input type="radio" id="rentDueNo" value="no" name="rent_due"
                                            class="form-check-input">
                                        <label for="rentDueNo" class="form-check-label">No</label>
                                    </div>
                                    <div class="form-check-inline mr-10">
                                        <input type="radio" id="rentDueYes" value="yes" name="rent_due"
                                            class="form-check-input">
                                        <label for="rentDueYes" class="form-check-label">Yes</label>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div> --}}
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

            $(document).on('change', '#floor_id', function() {
                let houseId = $(this).val();

                if (houseId) {
                    $.ajax({
                        url: "{{ route('get.units', ':houseId') }}".replace(':houseId',
                            houseId),
                        method: 'GET',
                        success: function(data) {
                            let floorSelect = $(
                                'select[name="unit_id"]');
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
                    $('select[name="unit_id"]').html('<option value="">No Record Found</option>');
                }
            });

        });
    </script>
@endsection
