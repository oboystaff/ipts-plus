@extends('layout.base')

@section('page-styles')
@endsection


@section('page-content')
    <div class="row">
        @foreach ($total['regions'] as $index => $region)
            <div class="col-xxl-12">
                <div class="card custom-card">
                    <div class="card-header">
                        <div class="card-title">{{ $region->name }}</div>
                    </div>
                    <div class="card-body">
                        @if ($region->assemblies->count() > 0)
                            <div class="table-responsive">
                                <table class="table table-bordered text-nowrap w-100" id="file-export-{{ $region->id }}">
                                    <thead>
                                        <tr>
                                            <th>S/N</th>
                                            <th>Assembly Name</th>
                                            <th>Total Properties</th>
                                            <th>Total Businesses</th>
                                            <th>Total Bills (GHS)</th>
                                            <th>Total Payments (GHS)</th>
                                            <th>Total Receivables (GHS)</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $regionTotalProperties = 0;
                                            $regionTotalBusinesses = 0;
                                            $regionTotalBills = 0;
                                            $regionTotalPayments = 0;
                                            $regionTotalReceivables = 0;
                                        @endphp

                                        @foreach ($region->assemblies as $key => $assembly)
                                            @php
                                                $totalPropertiesCount = $assembly->properties->count();
                                                $totalBusinessesCount = $assembly->businesses->count();
                                                $totalBills = $assembly->bills->sum('amount');
                                                $totalPayments = $assembly->payments
                                                    ->filter(function ($payment) {
                                                        if ($payment->payment_mode == 'momo') {
                                                            return $payment->transaction_status == 'Success';
                                                        }
                                                        return true;
                                                    })
                                                    ->sum('amount');
                                                $totalReceivables = $totalBills - $totalPayments;

                                                $regionTotalProperties += $totalPropertiesCount;
                                                $regionTotalBusinesses += $totalBusinessesCount;
                                                $regionTotalBills += $totalBills;
                                                $regionTotalPayments += $totalPayments;
                                                $regionTotalReceivables += $totalReceivables;
                                            @endphp

                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td>{{ $assembly->name }}</td>
                                                <td>{{ $totalPropertiesCount }}</td>
                                                <td>{{ $totalBusinessesCount }}</td>
                                                <td>{{ number_format($totalBills, 2) }}</td>
                                                <td>{{ number_format($totalPayments, 2) }}</td>
                                                <td>{{ number_format($totalReceivables, 2) }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th colspan="2" class="text-right">Totals:</th>
                                            <th>{{ $regionTotalProperties }}</th>
                                            <th>{{ $regionTotalBusinesses }}</th>
                                            <th>{{ number_format($regionTotalBills, 2) }}</th>
                                            <th>{{ number_format($regionTotalPayments, 2) }}</th>
                                            <th>{{ number_format($regionTotalReceivables, 2) }}</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        @else
                            <p>No assemblies available for this region.</p>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection

@section('page-scripts')
    <script>
        $(document).ready(function() {
            $('table[id^="file-export-"]').each(function() {
                $(this).DataTable({
                    dom: 'Bfrtip',
                    buttons: ['copy', 'csv', 'excel', 'pdf', 'print'],
                    language: {
                        searchPlaceholder: 'Search...',
                        sSearch: '',
                    },
                    responsive: true,
                    pageLength: 10,
                    lengthMenu: [5, 10, 25, 50, 100],
                });
            });
        });
    </script>
@endsection
