@extends('admin.masterAdmin')
@section('content')
    <!-- BEGIN: Page content-->
    <div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card card-fullheight">
                    <div class="card-header">
                        <h5 class="box-title">Edit Note</h5>
                    </div>
                    <div class="card-body">
                        @include('components/alert')

                        <form action="{{ route('remainder.update', $remainder->id) }}" enctype="multipart/form-data"
                            method="POST">
                            @csrf
                            @method('PUT') <!-- Specify the PUT method for updating -->

                            <div class="row">
                                <!-- Select Renter -->
                                <div class="col-12 col-md-6 col-lg-6">
                                    <div class="form-group mb-4">
                                        <label for="title">Select Renter<span style="color: red;">*</span></label>
                                        <select name="renter_id" id="renter_id" class="form-control select2_demo">
                                            <option value="">Select an Option</option>
                                            @foreach ($renters as $item)
                                                <option value="{{ $item->id }}"
                                                    {{ $item->id == $remainder->renter_id ? 'selected' : '' }}>
                                                    {{ $item->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <!-- Date -->
                                <div class="col-12 col-md-6 col-lg-6">
                                    <div class="form-group mb-4">
                                        <label for="date">Date<span style="color: red;">*</span></label>
                                        <input type="text" name="date" id="" required
                                            class="form-control datetimepicker_5"
                                            value="{{ old('date', \Carbon\Carbon::parse($remainder->date)->format('d-m-Y')) }}"
                                            placeholder="Date">
                                    </div>
                                </div>

                                <!-- Note -->
                                <div class="col-12 col-md-6 col-lg-6">
                                    <div class="form-group mb-4">
                                        <label for="note">Note <span style="color: red;">*</span></label>
                                        <textarea name="note" id="" class="form-control" placeholder="Note" rows="2">{{ old('note', $remainder->note) }}</textarea>
                                    </div>
                                </div>

                                <!-- Status -->
                                <div class="col-12 col-md-6 col-lg-6">
                                    <div class="form-group mb-4">
                                        <label>Select Status<span style="color: red;">*</span></label>
                                        <select class="form-control select2_demo" name="status" required>
                                            <option value="2" {{ $remainder->status == 2 ? 'selected' : '' }}>Completed
                                            </option>
                                            <option value="1" {{ $remainder->status == 1 ? 'selected' : '' }}>In
                                                Processing</option>
                                            <option value="0" {{ $remainder->status == 0 ? 'selected' : '' }}>Cancel
                                            </option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group mr-2">
                                <button class="btn btn-primary" type="submit">Update</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END: Page content-->
@endsection
