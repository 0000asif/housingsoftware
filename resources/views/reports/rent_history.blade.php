@extends('admin.masterAdmin')
@section('content')
    <div class="page-content fade-in-up">
        <!-- BEGIN: Page heading-->
        <div class="page-heading">
            <div class="page-breadcrumb">
                <h1 class="page-title">Rent History</h1>
            </div>
        </div>
        <!-- BEGIN: Page content-->
        <div>
            <div class="card">
                <div class="card-body">
                    <form class=" form-success mb-4" method="post">
                        <div class="row">

                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="year">Select Year <span class="material-icons"
                                            style="color: red;font-size: 10px;">star_rate</span></label>
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
                            </div>

                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="month">Select Month <span class="material-icons"
                                            style="color: red;font-size: 10px;">star_rate</span></label>
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
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="">House </label>
                                    <div class="md-form m-0">
                                        <select name="project_id" id="project_id" class="form-control select2_demo">
                                            <option value="">Select an option</option>
                                            @foreach ($houses as $staff)
                                                <option value="{{ $staff->id }}">{{ $staff->house_name }} {{ $staff->address }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="form-group">
                                    <label class="">Status <span class="material-icons"
                                            style="color: red;font-size: 10px;">name</span></label>
                                    <div class="md-form m-0">
                                        <select name="status" id="status" class="form-control select2_demo">
                                            <option value="">Select Status</option>
                                            <option value="2" {{ request('status') == '2' ? 'selected' : '' }}>Full
                                                Paid
                                            </option>
                                            <option value="1" {{ request('status') == '1' ? 'selected' : '' }}>Due
                                            </option>
                                            <option value="0" {{ request('status') == '0' ? 'selected' : '' }}>Pending
                                            </option>
                                        </select>
                                    </div>
                                </div>
                            </div>


                            <div class="col-md-2">
                                <div class="form-group">
                                    <button class="btn btn-primary btn-block" id="report" type="submit"
                                        style="margin-top:28px">REPORTS</button>
                                </div>
                            </div>
                        </div>
                        {!! Form::close() !!}
                </div>
            </div>
            <center><img src="{{ asset('image/loading.gif') }}" style="display: none;" id="loader" alt="">
            </center>
            <span id="get_content"></span>

        </div>
        <!-- END: Page content-->
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            $('#report').click(function(e) {
                e.preventDefault();

                // Get input values
                var year = $('#year').val();
                var month = $('#month').val();
                var status = $('#status').val();
                var project_id = $('#project_id').val();

                // Validate year field
                if (year === '') {
                    alert('Please select a year.');
                    return false;
                }

                // Show loader
                $('#loader').css("display", "block");

                // Perform AJAX request
                $.ajax({
                    url: "{{ url('/getrentreport') }}", // URL for the AJAX request
                    type: 'GET', // Use GET method
                    data: {
                        year: year,
                        month: month,
                        status: status,
                        project_id: project_id,
                    },
                    success: function(response) {
                        // Hide loader
                        $('#loader').css("display", "none");

                        if (response === 'f1') {
                            alert('No report found.');
                        } else {
                            // Populate the content with the server response
                            $('#get_content').html(response);
                        }
                    },
                    error: function(xhr, status, error) {
                        // Hide loader and show error
                        $('#loader').css("display", "none");
                        alert('An error occurred: ' + error);
                    }
                });
            });
        });
    </script>
@endsection
