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
    </style>
@endsection
@section('content')
    @include('category.update')
    <!-- BEGIN: Page content-->
    <div>
        <div class="card">
            <div class="card-header">
                <h5 class="box-title">Add Renter</h5>
                <a href="{{ route('renter.index') }}" class="btn btn-success btn-sm">Back</a>
            </div>
            <div class="card-body">
                <br>
                @include('components/alert')
                <form action="{{ route('renter.store') }}" enctype="multipart/form-data" method="post">
                    @csrf
                    <!-- Main Renter Information -->
                    <div class="form-section">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="renterName" class="form-label">Renter Name<span
                                        style="color: red;">*</span></label>
                                <input type="text" id="renterName" name="name" required class="form-control"
                                    placeholder="Enter renter name">
                            </div>
                            <div class="col-md-6">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" id="email" name="email" class="form-control"
                                    placeholder="Enter renter Email">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="nid" class="form-label">NID <span style="color: red;">*</span></label>
                                <input type="number" id="nid" required name="nid" class="form-control"
                                    placeholder="Enter NID">
                            </div>
                            <div class="col-md-6">
                                <label for="phone" class="form-label">Phone<span style="color: red;">*</span></label>
                                <input type="tel" id="phone" name="phone" required class="form-control"
                                    placeholder="Enter phone number">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="gender" class="form-label">Gender <span style="color: red;">*</span></label>
                                <select id="gender" name="gender" required class="form-control select2_demo">
                                    <option value="">--Select--</option>
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                    <option value="other">Other</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="rentDate" class="form-label">Date Of Birth</label>
                                <input type="text" id="rentDate" name="birth_date" placeholder="BirthDate"
                                    class="form-control datetimepicker_5">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="regnumber" class="form-label">Birth Registration number</label>
                                <input type="number" id="regnumber" name="regnumber" class="form-control"
                                    placeholder="Birth Registration number">
                            </div>
                            <div class="col-md-6">
                                <label for="occupation" class="form-label">Occupation<span
                                        style="color: red;">*</span></label>
                                <input type="text" id="occupation" name="occupation" required class="form-control"
                                    placeholder="Enter Occupation">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="institute" class="form-label">Institute Name</label>
                                <input type="text" id="institute" name="institute" class="form-control"
                                    placeholder="Institute Name">
                            </div>
                            <div class="col-md-6">
                                <label for="other_info" class="form-label">Other Info</label>
                                <input type="text" id="other_info" name="other_info" class="form-control"
                                    placeholder="Other Info">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="address" class="form-label">Permanent Address<span
                                        style="color: red;">*</span></label>
                                <textarea id="address" required class="form-control" name="address" rows="2"></textarea>
                            </div>
                            <div class="col-md-6">
                                <label for="pdf_file" class="form-label">Pdf File Asset</label>
                                <input type="File" id="pdf_file" name="pdf_file" class="form-control">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <label for="note" class="form-label">Remarks</label>
                                <textarea id="note" class="form-control" name="note" rows="2"></textarea>
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
