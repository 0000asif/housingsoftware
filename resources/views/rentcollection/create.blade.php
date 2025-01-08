@extends('admin.masterAdmin')
@section('content')
    @include('category.update')
    <!-- BEGIN: Page content-->
    <div>
        <div class="card">
            <div class="card-header">
                <h5 class="box-title">Add Rent Collection</h5>
            </div>
            <div class="card-body">
                <br>
                @include('components/alert')
                <form action="{{ route('collect.rent') }}" method="POST">
                    @csrf
                    <input name="method_id" type="hidden" id="method_id">
                    <div class="row">
                        <div class="col-12 col-md-6 col-lg-6 mb-2">
                            <label for="agreement_id">Select Agreement <span style="color: red;">*</span></label>
                            <select class="form-control select2_demo" name="agreement_id" id="agreement_id" required>
                                <option value="">Select an Option</option>
                                @foreach ($rents as $item)
                                    <option value="{{ $item->id }}">{{ $item->renter->name }} -
                                        {{ $item->renter->phone }} - {{ $item->floor->name }}-
                                        {{ $item->unit->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-12 col-md-6 col-lg-6 mb-2">
                            <label>Due Amount</label>
                            <input class="form-control" readonly placeholder="Due Amount" type="number" id="due_amount">
                        </div>

                        <div class="col-12 col-md-6 col-lg-6 mb-2">
                            <label for="collection_details">Collection Details:</label>
                            <div id="collection_details">No data available.</div>
                        </div>

                        <div class="col-12 col-md-6 col-lg-6">
                            <div class="form-group mb-4">
                                <label>Payment Method<span style="color: red;">*</span></label>
                                <select class="form-control select2_demo" id="payment_method" name="payment_method"
                                    required>
                                    <option value="">Select an Option</option>
                                    @foreach ($methods as $value)
                                        <option value="{{ $value->name }}" data-method="{{ $value->id }}">
                                            {{ $value->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-12 col-md-6 col-lg-6 mb-2">
                            <label for="amount_paid">Collection Amount <span style="color: red;">*</span></label>
                            <input class="form-control" placeholder="Paid Amount" type="number" name="amount_paid"
                                id="amount_paid" required>
                        </div>
                        <div class="col-12 col-md-6 col-lg-6 mb-2">
                            <label for="month">Month <span style="color: red;">*</span></label>
                            <select class="form-control select2_demo" name="month" id="month" required>
                                <option value="">Select Month</option>
                                <option value="1">January</option>
                                <option value="2">February</option>
                                <option value="3">March</option>
                                <option value="4">April</option>
                                <option value="5">May</option>
                                <option value="6">June</option>
                                <option value="7">July</option>
                                <option value="8">August</option>
                                <option value="9">September</option>
                                <option value="10">October</option>
                                <option value="11">November</option>
                                <option value="12">December</option>
                            </select>
                        </div>

                        <div class="col-12 col-md-6 col-lg-6 mb-2">
                            <label for="year">Year <span style="color: red;">*</span></label>
                            <select class="form-control select2_demo" name="year" id="year" required>
                                <option value="">Select an Option</option>
                                @php
                                    $currentYear = date('Y');
                                    $futureYears = 7;
                                @endphp
                                <option value="{{ $currentYear - 1 }}">{{ $currentYear - 1 }}</option>
                                @for ($year = $currentYear; $year <= $currentYear + $futureYears; $year++)
                                    <option value="{{ $year }}">{{ $year }}</option>
                                @endfor
                            </select>
                        </div>

                        <div class="col-12 col-md-6 col-lg-6 mb-2">
                            <label for="payment_date">Collection Date <span style="color: red;">*</span></label>
                            <input class="form-control datetimepicker_5" placeholder="Select Payment Date" type="text"
                                name="payment_date" id="payment_date" value="{{ date('d-m-Y') }}" required>
                        </div>

                        <div class="col-12 col-md-6 col-lg-6 mb-4">
                            <label for="notes">Remarks</label>
                            <textarea class="form-control" name="notes" placeholder="If any note" id="notes"></textarea>
                        </div>
                    </div>
                    <button class="btn btn-success " type="submit">Submit</button>
                </form>
            </div>
        </div>

    </div>
    <!-- END: Page content-->
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },

            });
        });

        $(document).ready(function() {
            $(document).on('change', '#agreement_id', function() {
                let houseId = $(this).val();

                if (houseId) {
                    $.ajax({
                        url: "{{ route('get.due', ':rentId') }}".replace(':rentId', houseId),
                        method: 'GET',
                        success: function(data) {
                            if (data.error) {
                                console.error(data.error);
                                $('#due_amount').val('');
                                $('#collection_details').html('No data available.');
                                return;
                            }

                            // Populate due amount
                            $('#due_amount').val(data.due_amount);

                            // Populate collection details
                            let collectionHtml = '';
                            data.collection_details.forEach(detail => {
                                collectionHtml += `
                            <div>
                                <strong>Month:</strong> ${detail.month} <br>
                                <strong>Year:</strong> ${detail.year} <br>
                                <strong>Collected Amount:</strong> ${detail.collection_amount}
                            </div><hr>`;
                            });

                            $('#collection_details').html(collectionHtml);
                        },
                        error: function(err) {
                            console.error(err.responseText);
                            $('#due_amount').val('');
                            $('#collection_details').html('Error fetching data.');
                        }
                    });
                } else {
                    $('#due_amount').val('');
                    $('#collection_details').text('');
                }
            });
        });



        $(document).ready(function() {
            $(document).on('change', '#payment_method', function() {
                let selectedOption = $(this).find(':selected');
                let houseId = selectedOption.data('method');
                $('#method_id').val(houseId);



            });

        });
    </script>
@endsection
