@extends('admin.masterAdmin')
@section('content')
    @include('category.update')
    <!-- BEGIN: Page content-->
    <div>
        <div class="card">
            <div class="card-header">
                <h5 class="box-title">Cash to Bank Transaction</h5>
                <a href="{{ route('bankTransaction.index') }}" class="btn btn-success btn-sm">Back</a>
            </div>
            <div class="card-body">
                <br>
                @include('components/alert')

                <form action="{{ route('bankTransaction.store') }}" enctype="multipart/form-data" method="post">
                    @csrf
                    <div class="row">
                        <!-- Payment Method ID -->
                        <div class="col-12 col-md-6 col-lg-6">
                            <div class="form-group mb-4">
                                <label for="payment_method_id">Payment Method ID<span style="color: red;">*</span></label>
                                <select name="payment_method_id" id="payment_method_id" class="form-control select2_demo">
                                    <option value="">Select an option</option>
                                    @foreach ($methods as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <!-- Reference -->
                        <div class="col-12 col-md-6 col-lg-6">
                            <div class="form-group mb-4">
                                <label for="reference">Receipt Number</label>
                                <input type="text" name="reference" id="reference" required class="form-control"
                                    placeholder="Receipt Number">
                            </div>
                        </div>

                        <!-- Amount -->
                        <div class="col-12 col-md-6 col-lg-6">
                            <div class="form-group mb-4">
                                <label for="amount">Deposit Amount<span style="color: red;">*</span></label>
                                <input type="number" name="amount" id="amount" required class="form-control"
                                    placeholder="Amount">
                            </div>
                        </div>

                        <!-- Date -->
                        <div class="col-12 col-md-6 col-lg-6">
                            <div class="form-group mb-4">
                                <label for="date">Transaction Date<span style="color: red;">*</span></label>
                                <input type="text" name="date" id="date" required value="{{ date('d-m-Y') }}"
                                    class="form-control datetimepicker_5">
                            </div>
                        </div>

                        <!-- Image Upload -->
                        <div class="col-12 col-md-6 col-lg-6">
                            <div class="form-group mb-4">
                                <label for="image">Receipt Copy</label>
                                <input type="file" name="image" id="image" class="form-control" accept="image/*">
                            </div>
                        </div>

                        <!-- Note -->
                        <div class="col-12 col-md-6 col-lg-6">
                            <div class="form-group mb-4">
                                <label for="note">Note</label>
                                <textarea name="note" id="note" class="form-control" placeholder="Additional Notes" rows="3"></textarea>
                            </div>
                        </div>


                    </div>
                    <!-- Submit Button -->
                    <div class="form-group mr-2">
                        <button class="btn btn-primary" type="submit">Submit</button>
                    </div>
                </form>

            </div>
        </div>

    </div>
    <!-- END: Page content-->
@endsection
