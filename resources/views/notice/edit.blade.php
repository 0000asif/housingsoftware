@extends('admin.masterAdmin')
@section('content')
    <!-- BEGIN: Page content-->
    <div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card card-fullheight">
                    <div class="card-header">
                        <h5 class="box-title">Edit Notice</h5>
                    </div>
                    <div class="card-body">
                        @include('components/alert')

                        {!! Form::open(['route' => ['notice.update', $notice->id], 'method' => 'put', 'files' => true]) !!}

                        <div class="row">
                            <div class="col-12 col-md-6 col-lg-6">
                                <div class="form-group mb-4">
                                    <label for="title">Select Batch<span style="color: red;">*</span></label>
                                    <select name="batch_id" id="batch_id" class="form-control select2_demo">
                                        <option value="">Select an Option</option>
                                        @foreach ($batchs as $item)
                                            <option value="{{ $item->id }}"
                                                {{ $notice->batch_id == $item->id ? 'selected' : ' ' }}>
                                                {{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-12 col-md-6 col-lg-6">
                                <div class="form-group mb-4">
                                    <label for="title">Notice Title<span style="color: red;">*</span></label>
                                    <input type="text" name="title" id="" value="{{ $notice->title }}"
                                        required class="form-control" placeholder="Notice Title">
                                </div>
                            </div>
                            <div class="col-12 col-md-6 col-lg-6">
                                <div class="form-group mb-4">
                                    <label for="description">Description</label>

                                    <textarea name="description" id="" class="form-control" placeholder="description" rows="2">{{ $notice->description }} </textarea>
                                </div>
                            </div>
                            <div class="col-12 col-md-6 col-lg-6">
                                <div class="form-group mb-4">
                                    <label for="file">File <span style="color: red;">*</span></label>
                                    <input type="file" name="file" id="" class="form-control">
                                </div>
                                @if ($notice->file)
                                    <p>{{ $notice->file }}
                                        <a href="{{ asset('public/image/notice/' . $notice->file) }}" download=""
                                            class="btn btn-success btn-sm">Download</a>
                                    </p>
                                @endif
                            </div>
                            <div class="col-12 col-md-6 col-lg-6">
                                <div class="form-group mb-4">
                                    <label>Select Status<span style="color: red;">*</span></label>
                                    <select class="form-control select2_demo" name="status" required>
                                        <option value="">Select an option</option>
                                        <option value="0" {{ $notice->status == '0' ? 'selected' : '' }}>InActive
                                        </option>
                                        <option value="1" {{ $notice->status == '1' ? 'selected' : '' }}>Active
                                        </option>
                                    </select>
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
    </div>
    <!-- END: Page content-->
@endsection
