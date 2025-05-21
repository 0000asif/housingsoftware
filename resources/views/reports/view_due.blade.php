<style>
    @media print {

        #loader,
        #printReport {
            display: none;
        }

        body {
            font-family: Arial, sans-serif;
        }
    }
</style>
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-md-10">
                <h5 class="box-title" class="">Due Report {{ \Carbon\Carbon::create()->month($month)->format('F') }}
                    -
                    <?php echo $year; ?>
                </h5>
                <button id="printReport" class="btn btn-sm btn-primary">Print Report</button>
            </div>

        </div>

        <div class="table-responsive">
            <table class="table table-bordered" id="dt-scroll-horizonal" style="width:100%">
                <thead>
                    <tr>
                        <td>S/L</td>
                        <td>House</td>
                        <td>Floor</td>
                        <td>Unit</td>
                        <td>Name</td>
                        <td>Mobile</td>
                        <td>Total Amount</td>
                        <td>Collection Amount</td>
                        <td>Due Amount</td>
                </thead>
                </tr>
                <tbody>
                    @foreach ($salary_report as $report)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $report->rent->house->house_name }}</td>
                            <td>{{ $report->rent->floor->name }} </td>
                            <td>{{ $report->rent->unit->name }} </td>
                            <td>{{ $report->rent->renter->name }}</td>
                            <td>{{ $report->rent->renter->phone }}</td>
                            <td>{{ $report->total_amount }}</td>
                            <td>{{ $report->collection_amount }}</td>
                            <td>
                                {{ $report->total_amount - $report->collection_amount }} <!-- Due Amount -->
                            </td>
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
                    </tr>
                </tfoot>

            </table>


        </div>
    </div>
</div>
