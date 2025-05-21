@extends('admin.masterAdmin')
@section('content')
    <div class="page-content fade-in-up">
        <!-- BEGIN: Page heading-->
        <div class="page-heading">
            <div class="page-breadcrumb">
                <h1 class="page-title">Income Reports</h1>
            </div>
        </div>
        <!-- BEGIN: Page content-->
        <div>
            <div class="card">
                <div class="card-body">
                    <form class=" form-success mb-4" method="post">
                        <div class="row">
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label class="">From <span class="material-icons"
                                            style="color: red;font-size: 10px;">star_rate</span></label>
                                    <div class="md-form m-0">
                                        <input class="form-control datetimepicker_5" value="{{ date('Y-m-d') }}"
                                            type="text" id="from_date" name="from_date" placeholder="Select date"
                                            required>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="form-group">
                                    <label class="">To <span class="material-icons"
                                            style="color: red;font-size: 10px;">star_rate</span></label>
                                    <div class="md-form m-0">
                                        <input class="form-control datetimepicker_5" type="text" id="to_date"
                                            name="to_date" value="{{ date('Y-m-d') }}" placeholder="Select date" required>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="">House <span class="material-icons"
                                            style="color: red;font-size: 10px;">name</span></label>
                                    <div class="md-form m-0">
                                        <select name="house" id="house_id" class="form-control select2_demo">
                                            <option value="">Select House</option>
                                            @foreach ($all_house as $house)
                                                <option value="{{ $house->id }}">{{ $house->house_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="">Category <span class="material-icons"
                                            style="color: red;font-size: 10px;">name</span></label>
                                    <div class="md-form m-0">
                                        <select name="category" id="category_id" class="form-control select2_demo">
                                            <option value="">Select category</option>
                                            @foreach ($category as $category)
                                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="form-group">
                                    <button class="btn btn-primary btn-block" id="report" type="submit"
                                        style="margin-top:28px">REPORTS</button>
                                </div>
                            </div>
                        </div>
                        {!! Form::close() !!}
                </div>
            </div>
            <center><img src="{{ asset('image/loader.gif') }}" style="display: none;" id="loader" alt="">
            </center>
            <span id="get_content"></span>

        </div>
        <!-- END: Page content-->
    </div>
@endsection

@section('script')
    <script>
        $('#report').click(function(e) {
            e.preventDefault();

            var to_date = $('#to_date').val();
            var from_date = $('#from_date').val();
            var category_id = $('#category_id').val();
            var house_id = $('#house_id').val();


            if (from_date == '') {
                alert('Select From Date');
                return false;
            }
            if (to_date == '') {
                alert('Select To Date');
                return false;
            }


            $('#loader').removeAttr('style');
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                'url': "{{ url('/getincomereport') }}",
                'type': 'get',
                'dataType': 'text',
                data: {
                    from_date: from_date,
                    to_date: to_date,
                    category_id: category_id,
                    house_id: house_id
                },
                success: function(data) {
                    if (data == 'f1') {
                        $('#loader').attr("style", "display: none;");
                    } else {
                        $('#loader').attr("style", "display: none;");
                        $('#get_content').html(data);



                        $('#printReport').click(function() {
                            var printContents = document.getElementById('get_content')
                                .innerHTML;
                            var originalContents = document.body.innerHTML;

                            // Replace the body content with the report content for printing
                            document.body.innerHTML = printContents;
                            window.print();

                            // Restore the original body content after printing
                            document.body.innerHTML = originalContents;
                            location.reload();
                        });
                    }
                }
            });
        });
    </script>
@endsection
