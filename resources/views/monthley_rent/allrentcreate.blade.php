@extends('admin.masterAdmin')
@section('content')
    @include('category.update')
    <!-- BEGIN: Page content-->
    <div>
        <div class="card">
            <div class="card-header">
                <h5 class="box-title">All Rent Genarate</h5>
            </div>
            <div class="card-body">
                <br>
                @include('components/alert')
                <form action="{{ route('allgenerate.rent') }}" method="POST">
                    @csrf
                    <div class="row">

                        <div class="col-12 col-md-6 col-lg-6 mb-2">
                            <label for="house_id">Select House <span style="color: red;">*</span></label>
                            <select class="form-control select2_demo" name="house_id" id="house_id" required>
                                <option value="">Select an Option</option>
                                @foreach ($houses as $house)
                                    <option value="{{ $house->id }}">{{ $house->house_name }}</option>
                                @endforeach
                            </select>
                        </div>

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



                        <div class="col-12 col-md-6 col-lg-6 mb-2">
                            <label for="generate_date">Generate Date <span style="color: red;">*</span></label>
                            <input class="form-control datetimepicker_5" value="{{ date('d-m-Y') }}"
                                placeholder="Select genarate Date" type="text" name="generate_date" id="generate_date"
                                required>
                        </div>

                        <div class="col-12 col-md-6 col-lg-6 mb-4">
                            <label for="remarks">Remarks</label>
                            <textarea class="form-control" name="remarks" placeholder="If any note" id="remarks"></textarea>
                        </div>
                    </div>
                    <button class="btn btn-success " type="submit">Submit</button>
                </form>
            </div>
        </div>

    </div>
    <!-- END: Page content-->
@endsection
