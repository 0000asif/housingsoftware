@extends('admin.masterAdmin')
@section('content')
    <!-- BEGIN: Page content-->
    <div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card card-fullheight">
                    <div class="card-header">
                        <h5 class="box-title">Edit Renter</h5>
                        <a href="{{ route('renter.index') }}" class="btn btn-success btn-sm">Back</a>
                    </div>
                    <div class="card-body">
                        @include('components/alert')

                        {!! Form::open(['route' => ['renter.update', $renter->id], 'method' => 'put', 'files' => true]) !!}

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label>Select Status<span style="color: red;">*</span></label>
                                <select class="form-control select2_demo" name="status" required>
                                    <option value="">Select an option</option>
                                    <option value="0" {{ $renter->status == 0 ? 'selected' : '' }}>InActive
                                    </option>
                                    <option value="1" {{ $renter->status == 1 ? 'selected' : '' }}>Active
                                    </option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="renterName" class="form-label">Renter Name<span
                                        style="color: red;">*</span></label>
                                <input type="text" id="renterName" name="name" value="{{ $renter->name }}" required
                                    class="form-control">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="nid" class="form-label">NID <span style="color: red;">*</span></label>
                                <input type="text" id="nid" name="nid" value="{{ $renter->nid }}"
                                    class="form-control">
                            </div>
                            <div class="col-md-6">
                                <label for="phone" class="form-label">Phone<span style="color: red;">*</span></label>
                                <input type="tel" id="phone" name="phone" value="{{ $renter->phone }}"
                                    class="form-control">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="gender" class="form-label">Gender <span style="color: red;">*</span></label>
                                <select id="gender" name="gender" class="form-control">
                                    <option value="male" {{ $renter->gender == 'male' ? 'selected' : '' }}>Male
                                    </option>
                                    <option value="female" {{ $renter->gender == 'female' ? 'selected' : '' }}>Female
                                    </option>
                                    <option value="other" {{ $renter->gender == 'other' ? 'selected' : '' }}>Other
                                    </option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="birth_date" class="form-label">Date of Birth</label>
                                <input type="text" id="birth_date" name="birth_date" value="{{ $renter->birth_date }}"
                                    class="form-control datetimepicker_5">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="regnumber" class="form-label">Birth Registration Number</label>
                                <input type="text" id="regnumber" name="regnumber" value="{{ $renter->regnumber }}"
                                    class="form-control">
                            </div>
                            <div class="col-md-6">
                                <label for="occupation" class="form-label">Occupation<span
                                        style="color: red;">*</span></label>
                                <input type="text" id="occupation" name="occupation" value="{{ $renter->occupation }}"
                                    class="form-control">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="institute" class="form-label">Institute Name</label>
                                <input type="text" id="institute" value="{{ $renter->institute }}" name="institute"
                                    class="form-control" placeholder="Institute Name">
                            </div>
                            <div class="col-md-6">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" id="email" name="email" value="{{ $renter->email }}"
                                    class="form-control">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="address" class="form-label">Permanent Address<span
                                        style="color: red;">*</span></label>
                                <textarea id="address" required class="form-control" name="address" rows="2">{{ $renter->address }} </textarea>
                            </div>
                            <div class="col-md-6">
                                <label for="pdf_file" class="form-label">PDF File</label>
                                <input type="file" id="pdf_file" name="pdf_file" class="form-control">
                                @if ($renter->pdf_file)
                                    <p class="mt-2">Current File: {{ $renter->pdf_file }}</p>
                                @endif
                            </div>

                        </div>

                        <div class="row mb-3">
                            <div class="col-md-12">
                                <label for="note" class="form-label">Remarks</label>
                                <textarea id="note" class="form-control" name="note" rows="2">{{ $renter->note }}</textarea>
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
