<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-md-10">
                <h5 class="box-title" class="">Due Report <?php echo date('d-m-Y', strtotime($from_date)); ?> To <?php echo date('d-m-Y', strtotime($to_date)); ?>
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
                        <td>Total Amount</td>
                        <td>Collection Amount</td>
                        <td>Due Amount</td>
                        <td>Payment Date</td>
                </thead>
                </tr>
                <tbody>
                    @foreach ($salary_report as $report)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $report->rent->house->house_name }}</td>
                            <td>{{ $report->rent->renter->name }}</td>
                            <td>{{ $report->rent->renter->phone }}</td>
                            <td>{{ $report->total_amount }}</td>
                            <td>{{ $report->collection_amount }}</td>
                            <td>
                                {{ $report->total_amount - $report->collection_amount }} <!-- Due Amount -->
                            </td>
                            <td>{{ date('d-m-Y', strtotime($report->date)) }}</td>
                        </tr>
                    @endforeach
                </tbody>

                <tfoot>

                    <tr>
                        <td colspan="4"><strong>Total Due Amount:</strong></td>
                        <td><strong>{{ number_format($salary_report->sum('total_amount'), 2) }}</strong></td>
                        <td><strong>{{ number_format($salary_report->sum('collection_amount'), 2) }}</strong></td>
                        <td><strong>
                                {{ number_format(
                                    $salary_report->sum(function ($report) {
                                        return $report->total_amount - $report->collection_amount;
                                    }),
                                    2,
                                ) }}
                            </strong></td>
                        <td></td>
                    </tr>
                </tfoot>

            </table>


        </div>
    </div>
</div>
