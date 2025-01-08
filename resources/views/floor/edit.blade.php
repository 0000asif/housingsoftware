@extends('admin.masterAdmin')
@section('content')
    <!-- BEGIN: Page content-->
    <div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card card-fullheight">
                    <div class="card-header">
                        <h5 class="box-title">Edit Floor</h5>
                        <a href="{{ route('floor.index') }}" class="btn btn-success btn-sm">Back</a>
                    </div>
                    <div class="card-body">
                        @include('components/alert')

                        {!! Form::open(['route' => ['floor.update', $info->id], 'method' => 'put', 'files' => true]) !!}
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
                                    <label>Select House<span style="color: red;">*</span></label>
                                    <select class="form-control select2_demo" name="house_id" required>
                                        <option value="">Select an option</option>
                                        @foreach ($house as $item)
                                            <option value="{{ $item->id }}"
                                                {{ $info->house_id == $item->id ? 'selected' : '' }}>
                                                {{ $item->house_name }}-
                                                {{ $item->contract_number }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-12 col-md-6 col-lg-6">
                                <div class="form-group mb-4">
                                    <label for="owner_name">Floor Name<span style="color: red;">*</span></label>
                                    <input type="text" name="name" value="{{ $info->name }}" id=""
                                        class="form-control" placeholder="Floor Name">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group mb-4">
                                    <label for="contract_number">Floor INfo</label>
                                    <input type="text" name="info" value="{{ $info->info }}" id=""
                                        class="form-control" placeholder="Floor INfo">
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
