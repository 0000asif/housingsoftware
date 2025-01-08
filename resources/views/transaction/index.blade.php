@extends('admin.masterAdmin')
@section('content')
    <div>
        <div class="card">
            <div class="card-header">
                <h5 class="box-title">All Bank Transaction List</h5>
            </div>
            <div class="card-body">
                <br>
                @include('components/alert')
                <div class="table-responsive">
                    <table class="table table-bordered w-100" id="dt-responsive">

                        <thead class="thead-light">
                            <tr>
                                <th>SL</th>
                                <th>Date</th>
                                <th>Bank</th>
                                <th>Manual Number</th>
                                <th>Withdraw</th>
                                <th>Deposite</th>
                                <th>File</th>
                                <th>Type</th>
                                <th>Remarks</th>
                                <th>Actions</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($transactions as $key => $value)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ \Carbon\Carbon::parse($value->date)->format('d-M-Y') }}</td>
                                    <td>{{ $value->method->name }}</td>
                                    <td>{{ $value->reference ?? 'N/A' }}</td>
                                    <td>
                                        @if ($value->type == '2')
                                            {{ number_format($value->amount, 2) }}
                                        @endif
                                    </td>
                                    <td>
                                        @if ($value->type == '1')
                                            {{ number_format($value->amount, 2) }}
                                        @endif
                                    </td>
                                    <td>
                                        @if ($value->image)
                                            <a href="{{ asset('images/' . $value->image) }}" target="_blank">View
                                                Image</a>
                                        @else
                                            N/A
                                        @endif
                                    </td>
                                    <td>
                                        @if ($value->type == '2')
                                            Withdraw
                                        @elseif ($value->type == '1')
                                            Deposit
                                        @endif
                                    </td>
                                    <td>{{ $value->note ?? 'N/A' }}</td>
                                    <td>
                                        <form action="{{ route('bankTransaction.destroy', $value->id) }}" method="POST"
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

    </div>
    <!-- END: Page content-->
@endsection
