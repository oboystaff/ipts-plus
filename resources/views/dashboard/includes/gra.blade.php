 <div class="row">
     <div class="col-xxl-12">
         <div class="row">
             <div class="col-xl-3">
                 <div class="card custom-card">
                     <div class="card-body">
                         <div class="d-flex align-items-start gap-3 flex-wrap">
                             <div>
                                 <span class="avatar avatar-md avatar-rounded bg-primary shadow shadow-primary">
                                     <i class="ti ti-shopping-bag fs-5"></i>
                                 </span>
                             </div>
                             <div class="flex-fill">
                                 <div class="d-flex align-items-center justify-content-between mb-2">
                                     <span class="d-block"> Yearly BoP Bill</span>
                                 </div>
                                 <h4 class="fw-semibold mb-3 lh-1">GHS
                                     {{ $total['totalBusinessBill'] }} </h4>

                             </div>
                         </div>
                     </div>
                 </div>
             </div>
             <div class="col-xl-3">
                 <div class="card custom-card">
                     <div class="card-body">
                         <div class="d-flex align-items-start gap-3 flex-wrap">
                             <div>
                                 <span class="avatar avatar-md avatar-rounded bg-secondary shadow shadow-secondary">
                                     <i class="ti ti-currency-dollar fs-5"></i>
                                 </span>
                             </div>
                             <div class="flex-fill">
                                 <div class="d-flex align-items-center justify-content-between mb-2">
                                     <span class="d-block">Total Property Bill </span>
                                 </div>
                                 <h4 class="fw-semibold mb-3 lh-1"> GHS
                                     {{ $total['totalPropertyBill'] }}</h4>

                             </div>
                         </div>
                     </div>
                 </div>
             </div>
             <div class="col-xl-3">
                 <div class="card custom-card">
                     <div class="card-body">
                         <div class="d-flex align-items-start gap-3 flex-wrap">
                             <div>
                                 <span class="avatar avatar-md avatar-rounded bg-success shadow shadow-success">
                                     <i class="ti ti-box fs-5"></i>
                                 </span>
                             </div>
                             <div class="flex-fill">
                                 <div class="d-flex align-items-center justify-content-between mb-2">
                                     <span class="d-block">Yearly Revenue </span>
                                 </div>
                                 <span class="d-block mb-2"></span>
                                 <h4 class="fw-semibold mb-3 lh-1">GHS
                                     {{ $total['totalBill'] }}</h4>

                             </div>
                         </div>
                     </div>
                 </div>
             </div>
             <div class="col-xl-3">
                 <div class="card custom-card">
                     <div class="card-body">
                         <div class="d-flex align-items-start gap-3 flex-wrap">
                             <div>
                                 <span class="avatar avatar-md avatar-rounded bg-info shadow shadow-info">
                                     <i class="ti ti-moneybag fs-5"></i>
                                 </span>
                             </div>
                             <div class="flex-fill">
                                 <div class="d-flex align-items-center justify-content-between mb-2">
                                     <span class="d-block"> Cash Collections </span>
                                 </div>
                                 <span class="d-block mb-2"></span>
                                 <h4 class="fw-semibold mb-3 lh-1"> GHS
                                     {{ $total['yearlyCashPayments'] }}</h4>

                             </div>
                         </div>
                     </div>
                 </div>
             </div>
         </div>
     </div>
 </div>

 <div class="row">
     <div class="col-xxl-12 col-xl-12">
         <div class="card custom-card">
             <div class="card-header justify-content-between">
                 <div class="card-title">
                     Country Statistics
                 </div>
                 <a href="javascript:void(0);"
                     class="btn btn-light btn-wave btn-sm text-muted waves-effect waves-light">Export</a>
             </div>
             <div class="card-body">
                 <ul class="list-unstyled country-stats-list">
                     <li>
                         <div class="d-flex align-items-center gap-3">
                             <div class="lh-1">
                                 <span class="avatar avatar-md bg-light p-2">
                                     <img src="../assets/images/flags/india_flag.jpg" alt=""
                                         class="rounded-circle">
                                 </span>
                             </div>
                             <div class="flex-fill">
                                 <div class="d-flex mb-2 justify-content-between align-items-center">
                                     <div class="d-flex align-items-center gap-2">
                                         <span class="fw-semibold d-block">Overall Yearly Momo
                                             Payment</span>
                                     </div>
                                     <div class="fw-medium"><span class="text-danger me-1"><i
                                                 class="ti ti-arrow-down align-middle"></i></span><span>GHS
                                             {{ $total['yearlyMomoPayments'] }}</span>
                                         (65%)</div>
                                 </div>
                                 <div class="progress progress-xs progress-animate" role="progressbar"
                                     aria-valuenow="65" aria-valuemin="0" aria-valuemax="100">
                                     <div class="progress-bar" style="width: 65%"></div>
                                 </div>
                             </div>
                         </div>
                     </li>
                     <li>
                         <div class="d-flex align-items-center gap-3">
                             <div class="lh-1">
                                 <span class="avatar avatar-md bg-light p-2">
                                     <img src="../assets/images/flags/russia_flag.jpg" alt=""
                                         class="rounded-circle">
                                 </span>
                             </div>
                             <div class="flex-fill">
                                 <div class="d-flex mb-2 justify-content-between align-items-center">
                                     <div class="d-flex align-items-center gap-2">
                                         <span class="fw-semibold d-block">Total Yearly
                                             Payments</span>
                                     </div>
                                     <div class="fw-medium"><span class="text-success me-1"><i
                                                 class="ti ti-arrow-up align-middle"></i></span><span>GHS
                                             {{ $total['yearlyPayments'] }}</span>
                                         (55%)</div>
                                 </div>
                                 <div class="progress progress-xs progress-animate" role="progressbar"
                                     aria-valuenow="55" aria-valuemin="0" aria-valuemax="100">
                                     <div class="progress-bar bg-secondary" style="width: 55%">
                                     </div>
                                 </div>
                             </div>
                         </div>
                     </li>
                     <li>
                         <div class="d-flex align-items-center gap-3">
                             <div class="lh-1">
                                 <span class="avatar avatar-md bg-light p-2">
                                     <img src="../assets/images/flags/canada_flag.jpg" alt=""
                                         class="rounded-circle">
                                 </span>
                             </div>
                             <div class="flex-fill">
                                 <div class="d-flex mb-2 justify-content-between align-items-center">
                                     <div class="d-flex align-items-center gap-2">
                                         <span class="fw-semibold d-block">Total
                                             Receivables</span>
                                     </div>
                                     <div class="fw-medium"><span class="text-danger me-1"><i
                                                 class="ti ti-arrow-down align-middle"></i></span><span>>GHS
                                             {{ $total['yearlyReceivables'] }}</span>
                                         (69%)</div>
                                 </div>
                                 <div class="progress progress-xs progress-animate" role="progressbar"
                                     aria-valuenow="69" aria-valuemin="0" aria-valuemax="100">
                                     <div class="progress-bar bg-success" style="width: 69%">
                                     </div>
                                 </div>
                             </div>
                         </div>
                     </li>


                 </ul>
             </div>
         </div>
     </div>
 </div>

 <div class="row">
     <div class="col-xxl-12">
         <div class="row">
             <div class="col-xl-4">
                 <div class="card custom-card">
                     <div class="card-body">
                         <div class="d-flex align-items-start gap-3 flex-wrap">
                             <div>
                                 <span class="avatar avatar-md avatar-rounded bg-primary shadow shadow-primary">
                                     <i class="ti ti-shopping-bag fs-5"></i>
                                 </span>
                             </div>
                             <div class="flex-fill">
                                 <div class="d-flex align-items-center justify-content-between mb-2">
                                     <span class="d-block"> Total Properties</span>
                                 </div>
                                 <h4 class="fw-semibold mb-3 lh-1">
                                     {{ $total['totalProperties'] }}</h4>

                             </div>
                         </div>
                     </div>
                 </div>
             </div>
             <div class="col-xl-4">
                 <div class="card custom-card">
                     <div class="card-body">
                         <div class="d-flex align-items-start gap-3 flex-wrap">
                             <div>
                                 <span class="avatar avatar-md avatar-rounded bg-secondary shadow shadow-secondary">
                                     <i class="ti ti-currency-dollar fs-5"></i>
                                 </span>
                             </div>
                             <div class="flex-fill">
                                 <div class="d-flex align-items-center justify-content-between mb-2">
                                     <span class="d-block">Valued </span>
                                 </div>
                                 <h4 class="fw-semibold mb-3 lh-1">
                                     0.00%</h4>

                             </div>
                         </div>
                     </div>
                 </div>
             </div>
             <div class="col-xl-4">
                 <div class="card custom-card">
                     <div class="card-body">
                         <div class="d-flex align-items-start gap-3 flex-wrap">
                             <div>
                                 <span class="avatar avatar-md avatar-rounded bg-success shadow shadow-success">
                                     <i class="ti ti-box fs-5"></i>
                                 </span>
                             </div>
                             <div class="flex-fill">
                                 <div class="d-flex align-items-center justify-content-between mb-2">
                                     <span class="d-block">Un-Valued </span>
                                 </div>
                                 <span class="d-block mb-2"></span>
                                 <h4 class="fw-semibold mb-3 lh-1">0.00%</h4>
                             </div>
                         </div>
                     </div>
                 </div>
             </div>
         </div>
     </div>
 </div>

 <div class="row">
     <div class="col-xxl-12">
         <div class="row">
             <div class="col-xl-4">
                 <div class="card custom-card">
                     <div class="card-body">
                         <div class="d-flex align-items-start gap-3 flex-wrap">
                             <div>
                                 <span class="avatar avatar-md avatar-rounded bg-primary shadow shadow-primary">
                                     <i class="ti ti-shopping-bag fs-5"></i>
                                 </span>
                             </div>
                             <div class="flex-fill">
                                 <div class="d-flex align-items-center justify-content-between mb-2">
                                     <span class="d-block"> Total Businessess</span>
                                 </div>
                                 <h4 class="fw-semibold mb-3 lh-1">
                                     {{ $total['totalBusinesses'] }}</h4>
                             </div>
                         </div>
                     </div>
                 </div>
             </div>
             <div class="col-xl-4">
                 <div class="card custom-card">
                     <div class="card-body">
                         <div class="d-flex align-items-start gap-3 flex-wrap">
                             <div>
                                 <span class="avatar avatar-md avatar-rounded bg-secondary shadow shadow-secondary">
                                     <i class="ti ti-currency-dollar fs-5"></i>
                                 </span>
                             </div>
                             <div class="flex-fill">
                                 <div class="d-flex align-items-center justify-content-between mb-2">
                                     <span class="d-block">Validated </span>
                                 </div>
                                 <h4 class="fw-semibold mb-3 lh-1">
                                     0.00%</h4>

                             </div>
                         </div>
                     </div>
                 </div>
             </div>
             <div class="col-xl-4">
                 <div class="card custom-card">
                     <div class="card-body">
                         <div class="d-flex align-items-start gap-3 flex-wrap">
                             <div>
                                 <span class="avatar avatar-md avatar-rounded bg-success shadow shadow-success">
                                     <i class="ti ti-box fs-5"></i>
                                 </span>
                             </div>
                             <div class="flex-fill">
                                 <div class="d-flex align-items-center justify-content-between mb-2">
                                     <span class="d-block">Un-Validated </span>
                                 </div>
                                 <span class="d-block mb-2"></span>
                                 <h4 class="fw-semibold mb-3 lh-1">0.00%</h4>
                             </div>
                         </div>
                     </div>
                 </div>
             </div>
         </div>
     </div>
 </div>

 <div class="row">
     <div class="col-xxl-12">
         <div class="row">
             <div class="col-xl-4">
                 <div class="card custom-card">
                     <div class="card-body">
                         <div class="d-flex align-items-start gap-3 flex-wrap">
                             <div>
                                 <span class="avatar avatar-md avatar-rounded bg-primary shadow shadow-primary">
                                     <i class="ti ti-shopping-bag fs-5"></i>
                                 </span>
                             </div>
                             <div class="flex-fill">
                                 <div class="d-flex align-items-center justify-content-between mb-2">
                                     <span class="d-block"> Total Assemblies</span>
                                 </div>
                                 <h4 class="fw-semibold mb-3 lh-1">
                                     {{ $total['totalAssembly'] }}</h4>
                             </div>
                         </div>
                     </div>
                 </div>
             </div>
             <div class="col-xl-4">
                 <div class="card custom-card">
                     <div class="card-body">
                         <div class="d-flex align-items-start gap-3 flex-wrap">
                             <div>
                                 <span class="avatar avatar-md avatar-rounded bg-secondary shadow shadow-secondary">
                                     <i class="ti ti-currency-dollar fs-5"></i>
                                 </span>
                             </div>
                             <div class="flex-fill">
                                 <div class="d-flex align-items-center justify-content-between mb-2">
                                     <span class="d-block">Active </span>
                                 </div>
                                 <h4 class="fw-semibold mb-3 lh-1">
                                     0.00%</h4>

                             </div>
                         </div>
                     </div>
                 </div>
             </div>
             <div class="col-xl-4">
                 <div class="card custom-card">
                     <div class="card-body">
                         <div class="d-flex align-items-start gap-3 flex-wrap">
                             <div>
                                 <span class="avatar avatar-md avatar-rounded bg-success shadow shadow-success">
                                     <i class="ti ti-box fs-5"></i>
                                 </span>
                             </div>
                             <div class="flex-fill">
                                 <div class="d-flex align-items-center justify-content-between mb-2">
                                     <span class="d-block">In-Active </span>
                                 </div>
                                 <span class="d-block mb-2"></span>
                                 <h4 class="fw-semibold mb-3 lh-1">0.00%</h4>
                             </div>
                         </div>
                     </div>
                 </div>
             </div>
         </div>
     </div>
 </div>

 @include('dashboard.includes.analytics')

 <div class="accordion customized-accordion accordions-items-separate" id="customizedAccordion">
     <div class="accordion-item custom-accordion-danger">
         <h2 class="accordion-header" id="customizedAccordionThree">
             <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                 data-bs-target="#customized-AccordionThree" aria-expanded="false"
                 aria-controls="customized-AccordionThree">
                 Nationwide Assemblies Performance Overview
             </button>
         </h2>
         <div id="customized-AccordionThree" class="accordion-collapse collapse"
             aria-labelledby="customizedAccordionThree" data-bs-parent="#customizedAccordion">
             <div class="accordion-body">
                 <!-- Default accordion -->
                 <div class="accordion-body" id="accordion-regions">
                     @foreach ($total['regions'] as $index => $region)
                         <div class="accordion-item">
                             <div class="accordion-header rounded-lg" id="heading{{ $index }}"
                                 data-bs-toggle="collapse" data-bs-target="#collapse{{ $index }}"
                                 aria-controls="collapse{{ $index }}" aria-expanded="false" role="button">
                                 <span class="accordion-header-icon"></span>
                                 <span class="accordion-header-text">{{ $region->name }}</span>
                                 <span class="accordion-header-indicator"></span>
                             </div>
                             <div id="collapse{{ $index }}" class="collapse"
                                 aria-labelledby="heading{{ $index }}" data-bs-parent="#accordion-regions">
                                 <div class="accordion-body-text">
                                     @if ($region->assemblies->count() > 0)
                                         <div class="table table-bordered text-nowrap w-100">
                                             <table id="file-export-{{ $region->id }}">
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
                                                     @foreach ($region->assemblies as $key => $assembly)
                                                         @php
                                                             $totalPropertiesCount = $assembly->properties->count();
                                                             $totalBusinessesCount = $assembly->businesses->count();
                                                             $totalBills = $assembly->bills->sum('amount');
                                                             $totalBillsCount = isset($totalBills)
                                                                 ? number_format($totalBills, 2)
                                                                 : 0;
                                                             $totalPayments = $assembly->payments
                                                                 ->filter(function ($payment) {
                                                                     if ($payment->payment_mode == 'momo') {
                                                                         return $payment->transaction_status ==
                                                                             'Success';
                                                                     }

                                                                     return true;
                                                                 })
                                                                 ->sum('amount');
                                                             $totalPaymentsCount = isset($totalPayments)
                                                                 ? number_format($totalPayments, 2)
                                                                 : 0;
                                                             $totalReceivables = $totalBills - $totalPayments;
                                                         @endphp

                                                         <tr>
                                                             <td>{{ $key + 1 }}</td>
                                                             <td>{{ $assembly->name }}</td>
                                                             <td>{{ $totalPropertiesCount }}</td>
                                                             <td>{{ $totalBusinessesCount }}</td>
                                                             <td>{{ $totalBillsCount }}</td>
                                                             <td>{{ $totalPaymentsCount }}</td>
                                                             <td>{{ number_format($totalReceivables, 2) }}
                                                             </td>
                                                         </tr>
                                                     @endforeach
                                                 </tbody>
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
             </div>
         </div>
     </div>
 </div>
