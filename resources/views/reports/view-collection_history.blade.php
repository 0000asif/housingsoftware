<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-md-10">
                <h5 class="box-title" class="">Collection Report <?php echo date('d-m-Y', strtotime($from_date)); ?> To <?php echo date('d-m-Y', strtotime($to_date)); ?>
                </h5>
            </div>

        </div>

        <div class="table-responsive">
            <table class="table table-bordered" id="dt-scroll-horizonal" style="width:100%">
                <thead>
                    <tr>
                        <td>S/L</td>
                        <td>House</td>
                        <td>Name</td>
                        <td>Mobile</td>
                        <td>Payment Amount</td>
                        <td>Payment Method</td>
                        <td>Payment Date</td>
                </thead>
                </tr>
                <tbody>
                    @foreach ($salary_report as $report)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $report->rent->house->house_name }}</td>
                            <td>{{ $report->monthly_rent->rent->renter->name }} </td>
                            <td>{{ $report->monthly_rent->rent->renter->phone }}</td>
                            <td>{{ $report->amount_paid }}</td>

                            <td>
                                {{ $report->payment_method }}
                            </td>
                            <td>{{ date('d-m-Y', strtotime($report->payment_date)) }} </td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="4"><strong>Total:</strong></td>
                        <td><strong>{{ number_format($salary_report->sum('amount_paid'), 2) }}</strong></td>
                        <td></td>
                        <td></td>
                    </tr>
                </tfoot>
            </table>


        </div>
    </div>
</div>
