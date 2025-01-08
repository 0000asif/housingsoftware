@extends('admin.masterAdmin')
@section('content')
    <!-- BEGIN: Page content-->
    <div class="row">
        <div class="col-lg-12">
            <div class="card card-fullheight">
                <div class="card-header">
                    <h5 class="box-title">Edit Syllabus</h5>
                    <a href="{{ route('syllabus.index') }}" class="btn btn-success btn-sm">Back</a>
                </div>
                <div class="card-body">
                    @include('components/alert')

                    {!! Form::open(['route' => ['syllabus.update', $syllabus->id], 'method' => 'put', 'files' => true]) !!}

                    <div class="row">
                        <div class="col-12 col-md-6 col-lg-6">
                            <div class="form-group mb-4">
                                <label for="title">Select Batch<span style="color: red;">*</span></label>
                                <select name="batch_id" id="batch_id" class="form-control select2_demo">
                                    <option value="">Select an Option</option>
                                    @foreach ($batchs as $item)
                                        <option value="{{ $item->id }}"
                                            {{ $syllabus->subject_id == $item->id ? 'selected' : ' ' }}>
                                            {{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 col-lg-6">
                            <div class="form-group mb-4">
                                <label for="title">Select Subject<span style="color: red;">*</span></label>
                                <select name="subject_id" id="subject_id" class="form-control select2_demo">
                                    <option value="">Select an Option</option>
                                    @foreach ($subjects as $item)
                                        <option value="{{ $item->id }}"
                                            {{ $syllabus->subject_id == $item->id ? 'selected' : ' ' }}>
                                            {{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 col-lg-6">
                            <div class="form-group mb-4">
                                <label for="title">Syllabus Title<span style="color: red;">*</span></label>
                                <input type="text" name="title" id="" value="{{ $syllabus->title }}" required
                                    class="form-control" placeholder="Syllabus Title">
                            </div>
                        </div>
                        <div class="col-12 col-md-6 col-lg-6">
                            <div class="form-group mb-4">
                                <label for="description">Description</label>

                                <textarea name="description" id="" class="form-control" placeholder="description" rows="2">{{ $syllabus->description }} </textarea>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 col-lg-6">
                            <div class="form-group mb-4">
                                <label for="file">File <span style="color: red;">*</span></label>
                                <input type="file" name="file" id="" class="form-control">
                            </div>
                            @if ($syllabus->file)
                                <p>{{ $syllabus->file }}
                                    <a href="{{ asset('public/image/syllabus/' . $syllabus->file) }}" download=""
                                        class="btn btn-success btn-sm">Download</a>
                                </p>
                            @endif
                        </div>
                        <div class="col-12 col-md-6 col-lg-6">
                            <div class="form-group mb-4">
                                <label>Select Status<span style="color: red;">*</span></label>
                                <select class="form-control select2_demo" name="status" required>
                                    <option value="">Select an option</option>
                                    <option value="0" {{ $syllabus->status == '0' ? 'selected' : '' }}>InActive
                                    </option>
                                    <option value="1" {{ $syllabus->status == '1' ? 'selected' : '' }}>Active
                                    </option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group"><button class="btn btn-primary mr-2" type="submit"
                            id="collection_button">Submit</button>
                    </div>

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
    <!-- END: Page content-->
@endsection
