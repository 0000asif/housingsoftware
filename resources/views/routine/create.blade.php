@extends('admin.masterAdmin')
@section('content')
    @include('category.update')
    <!-- BEGIN: Page content-->
    <div>
        <div class="card">
            <div class="card-header">
                <h5 class="box-title">Add Routine</h5>
                <a href="{{ route('routine.index') }}" class="btn btn-success btn-sm">Back</a>
            </div>
            <div class="card-body">
                <br>
                @include('components/alert')
                <form action="{{ route('routine.store') }}" enctype="multipart/form-data" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-12 col-md-6 col-lg-6">
                            <div class="form-group mb-4">
                                <label for="title">Select Batch<span style="color: red;">*</span></label>
                                <select name="batch_id" id="batch_id" class="form-control select2_demo">
                                    <option value="">Select an Option</option>
                                    @foreach ($batchs as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 col-lg-6">
                            <div class="form-group mb-4">
                                <label for="title">Routine Title<span style="color: red;">*</span></label>
                                <input type="text" name="title" id="" required class="form-control"
                                    placeholder="Routine Title">
                            </div>
                        </div>
                        <div class="col-12 col-md-6 col-lg-6">
                            <div class="form-group mb-4">
                                <label for="description">Description</label>

                                <textarea name="description" id="" class="form-control" placeholder="description" rows="2"></textarea>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 col-lg-6">
                            <div class="form-group mb-4">
                                <label for="file">File <span style="color: red;">*</span></label>
                                <input type="file" name="file" id="" class="form-control">
                            </div>
                        </div>
                        <div class="col-12 col-md-6 col-lg-6">
                            <div class="form-group mb-4">
                                <label>Select Status<span style="color: red;">*</span></label>
                                <select class="form-control select2_demo" name="status" required>
                                    <option value="">Select an option</option>
                                    <option value="0">InActive
                                    </option>
                                    <option value="1">Active
                                    </option>
                                </select>
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
