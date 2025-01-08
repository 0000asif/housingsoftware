@extends('admin.masterAdmin')
@section('content')
    <!-- BEGIN: Page content-->
    <div>
        <div class="card">
            <div class="card-header">
                <h5 class="box-title">Increase/Decrease</h5>
            </div>
            <div class="card-body">
                <br>
                @include('components/alert')
                <form action="{{ route('RentIncreaseDecrease.Store') }}" enctype="multipart/form-data" method="post">
                    @csrf

                    <input type="hidden" id="renter_id" name="renter_id">

                    <!-- Main Renter Information -->
                    <div class="form-section">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Select Agreement<span style="color: red;">*</span></label>
                                <select class="form-control select2_demo" id="rent_id" name="rent_id" required>
                                    <option value="">Select an option</option>
                                    @foreach ($renters as $item)
                                        <option value="{{ $item->id }}">
                                            {{ $item->renter->name }}-
                                            {{ $item->renter->phone }}->
                                            {{ $item->house->house_name }}->
                                            {{ $item->floor->name }}->
                                            {{ $item->unit->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="rentDate" class="form-label">Date<span style="color: red;">*</span></label>
                                <input type="text" placeholder="Date" value="{{ date('d-m-Y') }}" required
                                    name="adjustment_date" id="rentDate" class="form-control datetimepicker_5">
                            </div>
                        </div>
                    </div>

                    <!-- Rent Details -->
                    <div class="form-section">
                        <div class="row">

                            <div class="col-12 col-md-6 col-lg-6 mb-2">
                                <label for="month">Month <span style="color: red;">*</span></label>
                                <select class="form-control select2_demo" name="month" id="month" required>
                                    <option value="">Select Month</option>
                                    <option value="1">January</option>
                                    <option value="2">February</option>
                                    <option value="3">March</option>
                                    <option value="4">April</option>
                                    <option value="5">May</option>
                                    <option value="6">June</option>
                                    <option value="7">July</option>
                                    <option value="8">August</option>
                                    <option value="9">September</option>
                                    <option value="10">October</option>
                                    <option value="11">November</option>
                                    <option value="12">December</option>
                                </select>
                            </div>

                            <div class="col-12 col-md-6 col-lg-6 mb-2">
                                <label for="year">Year <span style="color: red;">*</span></label>
                                <select class="form-control select2_demo" name="year" id="year" required>
                                    <option value="">Select an Option</option>
                                    @php
                                        $currentYear = date('Y');
                                        $futureYears = 7;
                                    @endphp
                                    <option value="{{ $currentYear - 1 }}">{{ $currentYear - 1 }}</option>
                                    @for ($year = $currentYear; $year <= $currentYear + $futureYears; $year++)
                                        <option value="{{ $year }}">{{ $year }}</option>
                                    @endfor
                                </select>
                            </div>
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
                                <input type="number" id="gatmanbill" name="gatmanbill" class="form-control"
                                    placeholder="0">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Lift bill</label>
                                <input type="number" id="lift_bill" name="lift_bill" class="form-control"
                                    placeholder="0">
                            </div>
                            {{-- <div class="col-md-6 mb-3">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label class="form-label">Car/Bike REG NO.</label>
                                        <input type="number" id="car_reg_no" name="car_reg_no" class="form-control"
                                            placeholder="0">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Car/Bike Qty</label>
                                        <input type="number" id="quantity" name="quantity" class="form-control"
                                            placeholder="0">
                                    </div>
                                </div>
                            </div> --}}
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Garage Bill</label>
                                <input type="number" id="garage_bill" name="garage_bill" class="form-control"
                                    placeholder="0">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Service Charge</label>
                                <input type="number" id="service_charge" name="service_charge" class="form-control"
                                    placeholder="0">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Remarks</label>
                                <textarea name="note" rows="3" class="form-control"></textarea>
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
            // When the renter selection changes
            $('#rent_id').change(function() {
                var rent_id = $(this).val();

                if (rent_id) {
                    $.ajax({
                        url: "{{ route('RentIncreaseDecrease.GetRenter') }}",
                        type: 'GET',
                        data: {
                            rent_id: rent_id
                        },
                        success: function(data) {
                            // Populate hidden fields with the data from the server
                            $('#renter_id').val(data.renter_id);
                        },
                        error: function(xhr, status, error) {
                            console.error('Error fetching renter details:', error);
                            alert('আগে তাকে ভাড়া প্রাদান করুন তারপর ভাড়া বৃদ্ধি করুন বা কমান');
                        }
                    });
                }
            });
        });
    </script>
@endsection
