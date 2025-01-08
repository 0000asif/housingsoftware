@extends('admin.masterAdmin')
@section('content')
    <!-- BEGIN: Page content-->
    <div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card card-fullheight">
                    <div class="card-header">
                        <h5 class="box-title">Edit House</h5>
                    </div>
                    <div class="card-body">
                        @include('components/alert')

                        {!! Form::open(['route' => ['house.update', $info->id], 'method' => 'put', 'files' => true]) !!}
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
                                    <label>House Name<span style="color: red;">*</span></label>
                                    <input class="form-control" type="text" name="house_name"
                                        value="{{ $info->house_name }}" required>
                                </div>
                            </div>

                            <div class="col-12 col-md-6 col-lg-6">
                                <div class="form-group mb-4">
                                    <label>Owner Name </label>
                                    <input class="form-control" type="text" name="owner_name"
                                        value="{{ $info->owner_name }}">
                                </div>
                            </div>


                            <div class="col-12 col-md-6 col-lg-6">
                                <div class="form-group mb-4">
                                    <label>Contract Number</label>
                                    <input class="form-control" type="text" name="contract_number"
                                        value="{{ $info->contract_number }}">
                                </div>
                            </div>

                            <div class="col-12 col-md-6 col-lg-6">
                                <div class="form-group mb-4">
                                    <label>Address <span style="color: red;">*</span> </label>
                                    <input class="form-control" type="text" name="address" value="{{ $info->address }}"
                                        required>
                                </div>
                            </div>

                            <div class="col-12 col-md-6 col-lg-6">
                                <div class="form-group mb-4">
                                    <label>Land Info </label>
                                    <input class="form-control" value="{{ $info->land_info }}" type="text"
                                        name="land_info" placeholder="Land INfo">
                                </div>
                            </div>


                            <div class="col-12 col-md-6 col-lg-6">
                                <div class="form-group mb-4">
                                    <label>Document File </label>
                                    <input type="file" class="form-control" name="document">
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
