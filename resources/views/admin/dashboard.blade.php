@extends('admin.masterAdmin')
@section('content')
    <!-- BEGIN: Page heading-->
    <div class="page-heading">
        <div class="page-breadcrumb">
            <h1 class="page-title">সারসংক্ষেপ</h1><br>
            {{-- @can('view category')
            <br><h1 class="page-title">Category</h1>
        @endcan --}}

        </div>
        <div class="subheader_daterange" id="subheader_daterange"><span class="subheader-daterange-label"><span
                    class="subheader-daterange-title"></span><span class="subheader-daterange-date"></span></span><button
                class="btn btn-floating btn-sm rounded-0" type="button"><i class="ti-calendar"></i></button></div>
    </div>
    <!-- BEGIN: Page content-->
    <div>
        @php
            use Carbon\Carbon;
            use App\Models\IncomeExpence;
            use App\Models\RentCollectionHistory;
            use App\Models\MonthlyRent;
            use App\Models\Remainder;
            use App\Models\Unit;

            $expense = IncomeExpence::where('type', '2')->sum('expence_amount');
            $today = Carbon::today();

            $startOfMonth = Carbon::now()->startOfMonth();
            $endOfMonth = Carbon::now()->endOfMonth();

            // Calculate total expenses for today
            $totalExpenseToday = IncomeExpence::where('type', '2')
                ->whereDate('created_at', $today)
                ->sum('expence_amount');

            $totalExpenseThisMonth = IncomeExpence::where('type', '2')
                ->whereBetween('created_at', [$startOfMonth, $endOfMonth]) // Filter by this month
                ->sum('expence_amount');
            // dd($totalExpenseToday);

            $collection = RentCollectionHistory::sum('amount_paid');
            // dd($collection);
            $collectionThisMonth = RentCollectionHistory::whereBetween('created_at', [$startOfMonth, $endOfMonth])->sum(
                'amount_paid',
            );
            $thisMonthRent = MonthlyRent::where('month', $today->month)->sum('total_amount');

            //Calculate Due Amount
            $collectionAmount = RentCollectionHistory::sum('amount_paid');
            $allRent = MonthlyRent::sum('total_amount');
            $dueAmount = $allRent - $collectionAmount;

            //pending rent list
            $monthlyRents = MonthlyRent::whereIn('status', [0, 1])->get();
            $data = Remainder::with('renter')->orderByDesc('created_at')->get();
            $unit = Unit::where('rent_status', '0')->get();
        @endphp

        {{-- show here all summaries --}}
        <div class="row">
            {{-- <div class="card col-md-3   text-white" style="background: #8BC53D;">
                <div class="card-body pr-4">
                    <div class="media">
                        <div class="media-body">
                            <div class="mb-2 font-16">নগদ টাকা</div>
                            <div class="d-flex" style="word-break: break-word;">
                                <div class="h5 mb-0 font-20">
                                    <span>৳ 122145344445200</span>
                                    <span class="font-weight-normal">Tk</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}
            <div class="card col-md-3   text-white" style="background: #922A8D;">
                <div class="card-body pr-4">
                    <div class="media">
                        <div class="media-body">
                            <div class="mb-2 font-16">মোট সংগ্রহ</div>
                            <div class="d-flex" style="word-break: break-word;">
                                <div class="h5 mb-0 font-20">
                                    <span>৳ {{ number_format($collection, 2) }}</span>
                                    <span class="font-weight-normal">Tk</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card  col-md-3 text-white" style="background: #06b5b6;">
                <div class="card-body pr-4">
                    <div class="media">
                        <div class="media-body">
                            <div class="mb-2 font-16">এই মাসের সংগ্রহ</div>
                            <div class="d-flex" style="word-break: break-word;">
                                <div class="h5 mb-0 font-20">
                                    <span>৳ {{ number_format($collectionThisMonth, 2) }}</span>
                                    <span class="font-weight-normal">Tk</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card  col-md-3 text-white" style="background: #EB6C49;">
                <div class="card-body pr-4">
                    <div class="media">
                        <div class="media-body">
                            <div class="mb-2 font-16">এই মাসের মোট ভাড়া</div>
                            <div class="d-flex" style="word-break: break-word;">
                                <div class="h5 mb-0 font-20">
                                    <span>৳ {{ number_format($thisMonthRent, 2) }}</span>
                                    <span class="font-weight-normal">Tk</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="card  col-md-3 text-white" style="background: #522D6C;">
                <div class="card-body pr-4">
                    <div class="media">
                        <div class="media-body">
                            <div class="mb-2 font-16">মোট খরচ</div>
                            <div class="d-flex" style="word-break: break-word;">
                                <div class="h5 mb-0 font-20">
                                    <span>৳ {{ number_format($expense, 2) }}</span>
                                    <span class="font-weight-normal">Tk</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card  col-md-3 text-white" style="background: #721a02;">
                <div class="card-body pr-4">
                    <div class="media">
                        <div class="media-body">
                            <div class="mb-2 font-16">এই মাসের খরচ</div>
                            <div class="d-flex" style="word-break: break-word;">
                                <div class="h5 mb-0 font-20">
                                    <span>৳ {{ number_format($totalExpenseThisMonth, 2) }}</span>
                                    <span class="font-weight-normal">Tk</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card  col-md-3 text-white" style="background: #08c;">
                <div class="card-body pr-4">
                    <div class="media">
                        <div class="media-body">
                            <div class="mb-2 font-16">আজকের খরচ</div>
                            <div class="d-flex" style="word-break: break-word;">
                                <div class="h5 mb-0 font-20">
                                    <span>৳ {{ number_format($totalExpenseToday, 2) }}</span>
                                    <span class="font-weight-normal">Tk</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card  col-md-3 text-white" style="background: #d322b5;">
                <div class="card-body pr-4">
                    <div class="media">
                        <div class="media-body">
                            <div class="mb-2 font-16">মোট বাকি</div>
                            <div class="d-flex" style="word-break: break-word;">
                                <div class="h5 mb-0 font-20">
                                    <span>৳ {{ number_format($dueAmount, 2) }}</span>
                                    <span class="font-weight-normal">Tk</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- all pending rent --}}
        <div class="card">
            <div class="card-header">
                <h5 class="box-title">পেন্ডিং ভাড়ার তালিকা</h5>
            </div>
            <div class="card-body">
                <br>
                @include('components/alert')
                <div class="table-responsive">
                    <table class="table table-bordered w-100" id="dt-responsive">

                        <thead class="thead-light">
                            <tr>
                                <th>SL</th>
                                <th>Created Date</th>
                                <th>Invoice</th>
                                <th>House</th>
                                <th>Floor</th>
                                <th>Unit</th>
                                <th>Name</th>
                                <th>Year</th>
                                <th>Month</th>
                                <th>Amount</th>
                                <th>Actions</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($monthlyRents as $key => $value)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ date('d-M-Y', strtotime($value->created_at)) }}</td>
                                    <td>{{ $value->id }}</td>
                                    <td>{{ $value->rent->house->house_name }}</td>
                                    <td>{{ $value->rent->floor->name }}</td>
                                    <td>{{ $value->rent->unit->name }}</td>
                                    <td>{{ $value->rent->renter->name }} -
                                        {{ $value->rent->renter->phone }}</td>

                                    <td>{{ $value->year }}</td>
                                    <td>{{ date('F', mktime(0, 0, 0, $value->month, 1)) }}</td>
                                    <td>{{ $value->total_amount }}</td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="{{ route('singleRentCollection.show', $value->id) }}"
                                                class="btn text-white btn-sm btn-primary">
                                                <i class="fa fa-eye"></i>
                                            </a>
                                            <a href="{{ route('singleRentCollection.print', $value->id) }}"
                                                class="btn text-white btn-sm btn-success">
                                                <i class="fa fa-print"></i>
                                            </a>
                                            <form action="{{ route('singleRentCollection.destroy', $value->id) }}"
                                                method="POST" id="delete-form-{{ $value->id }}">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" class="btn btn-danger btn-sm"
                                                    onclick="confirmDelete({{ $value->id }})"><i
                                                        class="fa fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>

                    </table>
                </div>
            </div>
        </div>

        {{-- all nots here  --}}
        <div class="card">
            <div class="card-header">
                <h5 class="box-title">নোটের তালিকা</h5>
            </div>
            <div class="card-body">
                <br>
                @include('components/alert')
                <div class="table-responsive">
                    <table class="table table-bordered w-100" id="dt-responsive2">

                        <thead class="thead-light">
                            <tr>
                                <th>SL</th>
                                <th>Created Date</th>
                                <th>Renter</th>
                                <th>Remainder Date</th>
                                <th>Note</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($data as $key => $value)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ date('d-M-Y', strtotime($value->created_at)) }}</td>
                                    <td>{{ $value->renter->name ?? 'N/A' }}</td>
                                    <td>{{ date('d-M-Y', strtotime($value->date)) }}</td>
                                    <td>{{ $value->note ?? 'N/A' }}</td>
                                    <td>
                                        @if ($value->status == '2')
                                            <span class="badge badge-success">Complete</span>
                                        @elseif ($value->status == '1')
                                            <span class="badge badge-warning">In process</span>
                                        @else
                                            <span class="badge badge-danger">Cancle</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('remainder.edit', $value->id) }}"
                                            class="btn text-white btn-sm btn-primary">
                                            <i class="fa fa-edit"></i></a>
                                        <form action="{{ route('remainder.destroy', $value->id) }}" method="POST"
                                            id="delete-form-{{ $value->id }}" style="display:inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="btn btn-danger btn-sm"
                                                onclick="confirmDelete({{ $value->id }})"><i class="fa fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>

                    </table>
                </div>
            </div>
        </div>

        {{-- Empty Unit list  --}}
        <div class="card">
            <div class="card-header">
                <h5 class="box-title">খালি ইউনিট এর তালিকা</h5>
            </div>
            <div class="card-body">
                <br>
                @include('components/alert')
                <div class="table-responsive">
                    <table class="table table-bordered w-100" id="dt-responsive3">

                        <thead class="thead-light">
                            <tr>
                                <th>SL</th>
                                <th>House</th>
                                <th>Floor</th>
                                <th>unit</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($unit as $key => $value)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $value->house->house_name }}</td>
                                    <td>{{ $value->floor->name }}</td>
                                    <td>{{ $value->name }}</td>
                                </tr>
                            @endforeach
                        </tbody>

                    </table>
                </div>
            </div>
        </div>


    </div><!-- END: Page content-->
@endsection
