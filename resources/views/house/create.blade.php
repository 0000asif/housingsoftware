@extends('admin.masterAdmin')
@section('content')
    @include('category.update')
    <!-- BEGIN: Page content-->
    <div>
        <div class="card">
            <div class="card-header">
                <h5 class="box-title">Add House</h5>
                <a href="{{ route('house.index') }}" class="btn btn-success btn-sm">Back</a>
            </div>
            <div class="card-body">
                <br>
                @include('components/alert')
                <form action="{{ route('house.store') }}" enctype="multipart/form-data" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-12 col-md-6 col-lg-6">
                            <div class="form-group mb-4">
                                <label for="house_name">House Name<span style="color: red;">*</span></label>
                                <input type="text" name="house_name" id="" required class="form-control"
                                    placeholder="House Name">
                            </div>
                        </div>
                        <div class="col-12 col-md-6 col-lg-6">
                            <div class="form-group mb-4">
                                <label for="owner_name">Owner Name</label>
                                <input type="text" name="owner_name" id="" class="form-control"
                                    placeholder="Oner Name">
                            </div>
                        </div>
                        <div class="col-12 col-md-6 col-lg-6">
                            <div class="form-group mb-4">
                                <label for="contract_number">Contact Number</label>
                                <input type="number" name="contract_number" id="" class="form-control"
                                    placeholder="Contact Number">
                            </div>
                        </div>
                        <div class="col-12 col-md-6 col-lg-6">
                            <div class="form-group mb-4">
                                <label for="holding_number">Holding Number</label>
                                <input type="number" name="holding_number" id="" class="form-control"
                                    placeholder="Holding Number">
                            </div>
                        </div>
                        <div class="col-12 col-md-6 col-lg-6">
                            <div class="form-group mb-4">
                                <label for="address">Address <span style="color: red;">*</span></label>

                                <textarea name="address" id="" required class="form-control" placeholder="Road Number and Full Address"
                                    rows="2"></textarea>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 col-lg-6">
                            <div class="form-group mb-4">
                                <label for="land_info">Land INfo</label>
                                <input type="text" name="land_info" id="" class="form-control"
                                    placeholder="Land Info">
                            </div>
                        </div>
                        <div class="col-12 col-md-6 col-lg-6">
                            <div class="form-group mb-4">
                                <label for="opening_balance">Opening Balance <span style="color: red;">*</span></label>
                                <input type="number" name="opening_balance" required class="form-control"
                                    placeholder="Opening Balance">
                            </div>
                        </div>
                        <div class="col-12 col-md-6 col-lg-6">
                            <div class="form-group mb-4">
                                <label for="opening_balance">Confirm Opening Balance<span
                                        style="color: red;">*</span></label>
                                <input type="number" name="confirm_balance" required class="form-control"
                                    placeholder="Confirm Opening Balance">
                            </div>
                        </div>
                        <div class="col-12 col-md-6 col-lg-6">
                            <div class="form-group mb-4">
                                <label for="document">Document</label>
                                <input type="file" name="document" id="" class="form-control">
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
