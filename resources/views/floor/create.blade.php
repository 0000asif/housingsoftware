@extends('admin.masterAdmin')
@section('content')
    @include('category.update')
    <!-- BEGIN: Page content-->
    <div>
        <div class="card">
            <div class="card-header">
                <h5 class="box-title">Add Floor</h5>
                <a href="{{ route('floor.index') }}" class="btn btn-success btn-sm">Back</a>
            </div>
            <div class="card-body">
                <br>
                @include('components/alert')
                <form action="{{ route('floor.store') }}" enctype="multipart/form-data" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-12 col-md-6 col-lg-6">
                            <div class="form-group mb-4">
                                <label>Select House<span style="color: red;">*</span></label>
                                <select class="form-control select2_demo" name="house_id" required>
                                    <option value="">Select an option</option>
                                    @foreach ($house as $item)
                                        <option value="{{ $item->id }}">{{ $item->house_name }}-
                                            {{ $item->contract_number }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 col-lg-6">
                            <div class="form-group mb-4">
                                <label for="owner_name">Floor Name<span style="color: red;">*</span></label>
                                <input type="text" name="name" id="" class="form-control"
                                    placeholder="Floor Name">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group mb-4">
                                <label for="contract_number">Floor INfo</label>
                                <input type="text" name="info" id="" class="form-control"
                                    placeholder="Floor INfo">
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
