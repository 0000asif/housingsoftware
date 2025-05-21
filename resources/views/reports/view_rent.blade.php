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
                <h5 class="box-title" class="">Rent Report Year: {{ $year }} - Month:
                    {{ \Carbon\Carbon::create()->month($month)->format('F') }}
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
                        <td>Total </td>
                        <td>Advance</td>
                        <td>Collection </td>
                        <td>Due Amount</td>
                        <td>Payment Date</td>
                </thead>
                </tr>
                <tbody>
                    @foreach ($rent_report as $report)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $report->rent->house->house_name }} </td>
                            <td>{{ $report->rent->floor->name }} </td>
                            <td>{{ $report->rent->unit->name }} </td>
                            <td>{{ $report->rent->renter->name }} </td>
                            <td>{{ $report->rent->renter->phone }}</td>
                            <td>{{ $report->total_amount }}</td>
                            <td>{{ $report->advance_amount }}</td>
                            <td>{{ $report->collection_amount }}</td>
                            <td>
                                @php
                                    $total = $report->total_amount;
                                    $collection_amount = $report->collection_amount;
                                    $due_amount = $total - $collection_amount;
                                @endphp
                                {{ number_format($due_amount, 2) }}
                            </td>
                            <td>{{ date('d-m-Y', strtotime($report->date)) }} </td>
                        </tr>
                    @endforeach
                </tbody>

                <tfoot>
                    <tr>
                        <td colspan="6"><strong>Total:</strong></td>
                        <td><strong>
                                {{ number_format($rent_report->sum('total_amount'), 2) }}
                            </strong>
                        </td>
                        <td><strong>
                                {{ number_format($rent_report->sum('advance_amount'), 2) }}
                            </strong>
                        </td>
                        <td><strong>
                                {{ number_format($rent_report->sum('collection_amount'), 2) }}
                            </strong>
                        </td>
                        <td><strong>
                                {{ number_format(
                                    $rent_report->sum(function ($report) {
                                        return $report->total_amount - $report->collection_amount;
                                    }),
                                    2,
                                ) }}</strong>
                        </td>
                        <td></td>
                    </tr>
                </tfoot>

            </table>


        </div>
    </div>
</div>
