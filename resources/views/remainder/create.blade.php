@extends('admin.masterAdmin')
@section('content')
    @include('category.update')
    <!-- BEGIN: Page content-->
    <div>
        <div class="card">
            <div class="card-header">
                <h5 class="box-title">Add Note</h5>
                <a href="{{ route('remainder.index') }}" class="btn btn-success btn-sm">Back</a>
            </div>
            <div class="card-body">
                <br>
                @include('components/alert')
                <form action="{{ route('remainder.store') }}" enctype="multipart/form-data" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-12 col-md-6 col-lg-6">
                            <div class="form-group mb-4">
                                <label for="title">Select Renter<span style="color: red;">*</span></label>
                                <select name="renter_id" id="renter_id" class="form-control select2_demo">
                                    <option value="">Select an Option</option>
                                    @foreach ($renters as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-12 col-md-6 col-lg-6">
                            <div class="form-group mb-4">
                                <label for="date">date<span style="color: red;">*</span></label>
                                <input type="text" name="date" id="" required
                                    class="form-control datetimepicker_5" value="{{ date('d-m-Y') }}" placeholder="Date">
                            </div>
                        </div>

                        <div class="col-12 col-md-6 col-lg-6">
                            <div class="form-group mb-4">
                                <label for="note">Note <span style="color: red;">*</span></label>

                                <textarea name="note" id="" class="form-control" placeholder="note" rows="2"></textarea>
                            </div>
                        </div>

                        {{-- <div class="col-12 col-md-6 col-lg-6">
                            <div class="form-group mb-4">
                                <label>Select Status<span style="color: red;">*</span></label>
                                <select class="form-control select2_demo" name="status" required>
                                    <option value="2">Completed
                                    </option>
                                    <option value="1">In Processing
                                    </option>
                                    <option value="0">Cancle
                                    </option>
                                </select>
                            </div>
                        </div> --}}
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
