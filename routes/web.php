<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthAdmin;
use App\Http\Controllers\Dashboard;
use App\Http\Controllers\User;
use App\Http\Controllers\Role;
use App\Http\Controllers\Permission;
use App\Http\Controllers\Citizens\CitizenController;
use App\Http\Controllers\Businesses\BusinessController;
use App\Http\Controllers\BusinessClassTypes\BusinessClassTypeController;
use App\Http\Controllers\Properties\PropertyController;
use App\Http\Controllers\BillsManagement\BillsManagementController;
use App\Http\Controllers\BillsManagement\BusBillsManagementController;
use App\Http\Controllers\Assembly\AssemblyController;
use App\Http\Controllers\Divisions\DivisionController;
use App\Http\Controllers\Blocks\BlockController;
use App\Http\Controllers\CustomerType\CustomerTypeController;
use App\Http\Controllers\BusinessType\BusinessTypeController;
use App\Http\Controllers\BusinessClass\BusinessClassController;
use App\Http\Controllers\Zone\ZoneController;
use App\Http\Controllers\PropertyUser\PropertyUserController;
use App\Http\Controllers\Rate\RateController;
use App\Http\Controllers\Rate\BusRateController;
use App\Http\Controllers\Payment\PaymentController;
use App\Http\Controllers\Report;
use App\Http\Controllers\AgentAssignment\AgentAssignmentController;
use App\Http\Controllers\TaskAssignment\TaskAssignmentController;
use App\Http\Controllers\CustomerSupport\CustomerSupportController;
use App\Http\Controllers\Building\BuildingController;
use App\Http\Controllers\Mmda\MmdaController;



Route::get('/faqAction', [Dashboard\DashboardController::class, 'faqAction'])->name('dashboard.faq');

Route::group(['prefix' => 'payment', 'middleware' => 'auth:sanctum'], function () {
    Route::get('/', [PaymentController::class, 'index'])->name('payments.index');
    Route::get('/create/{bill}', [PaymentController::class, 'create'])->name('payments.create');
    Route::get('/customer/create/{bill}', [PaymentController::class, 'customerCreate'])->name('payments.customerCreate');
    Route::post('/create', [PaymentController::class, 'store'])->name('payments.store');
    Route::get('/{payment}/show', [PaymentController::class, 'show'])->name('payments.show');
    Route::get('/{payment}/receipt', [PaymentController::class, 'receipt'])->name('payments.receipt');
    Route::get('/{payment}/edit', [PaymentController::class, 'edit'])->name('payments.edit');
    Route::post('/{payment}/update', [PaymentController::class, 'update'])->name('payments.update');
    Route::post('/make/payment', [PaymentController::class, 'makePayment'])->name('payments.makePayment');
});

// route for bils
Route::group(['prefix' => 'bills-management', 'middleware' => 'auth:sanctum'], function () {
    Route::get('/', [BillsManagementController::class, 'index'])->name('bills.index');
    Route::get('/create', [BillsManagementController::class, 'create'])->name('bills.create');
    Route::post('/', [BillsManagementController::class, 'store'])->name('bills.store');
    Route::get('/single', [BillsManagementController::class, 'singleCreate'])->name('bills.singleCreate');
    Route::post('/single', [BillsManagementController::class, 'singleStore'])->name('bills.singleStore');
    Route::get('/division/bill', [BillsManagementController::class, 'divisionCreate'])->name('bills.divisionCreate');
    Route::post('/division/bill', [BillsManagementController::class, 'divisionStore'])->name('bills.divisionStore');
    Route::get('/block/bill', [BillsManagementController::class, 'blockCreate'])->name('bills.blockCreate');
    Route::post('/block/bill', [BillsManagementController::class, 'blockStore'])->name('bills.blockStore');
    Route::post('/property', [BillsManagementController::class, 'property'])->name('bills.property');
    Route::get('/fetch/bill', [BillsManagementController::class, 'fetchBill'])->name('bills.fetchBill');
    Route::get('/{bill}/receipt', [BillsManagementController::class, 'receipt'])->name('bills.receipt');
    Route::get('/{bill}', [BillsManagementController::class, 'show'])->name('bills.show');
    Route::get('/{id}/edit', [BillsManagementController::class, 'edit'])->name('bills.edit');
    Route::put('/{id}', [BillsManagementController::class, 'update'])->name('bills.update');
    Route::delete('/{id}', [BillsManagementController::class, 'destroy'])->name('bills.destroy');
});

Route::group(['prefix' => 'bus-bills-management', 'middleware' => 'auth:sanctum'], function () {
    Route::get('/', [BusBillsManagementController::class, 'index'])->name('bills.bus.index');
    Route::get('/create', [BusBillsManagementController::class, 'create'])->name('bills.bus.create');
    Route::post('/create', [BusBillsManagementController::class, 'store'])->name('bills.bus.store');
    Route::get('/{bill}/show', [BusBillsManagementController::class, 'show'])->name('bills.bus.show');
    Route::get('/{bill}/edit', [BusBillsManagementController::class, 'edit'])->name('bills.bus.show');
    Route::post('/{bill}/update', [BusBillsManagementController::class, 'update'])->name('bills.bus.update');
    Route::get('/single', [BusBillsManagementController::class, 'singleCreate'])->name('bills.bus.singleCreate');
    Route::post('/single', [BusBillsManagementController::class, 'singleStore'])->name('bills.bus.singleStore');
    Route::get('/division/bill', [BusBillsManagementController::class, 'divisionCreate'])->name('bills.bus.divisionCreate');
    Route::post('/division/bill', [BusBillsManagementController::class, 'divisionStore'])->name('bills.bus.divisionStore');
    Route::get('/block/bill', [BusBillsManagementController::class, 'blockCreate'])->name('bills.bus.blockCreate');
    Route::post('/block/bill', [BusBillsManagementController::class, 'blockStore'])->name('bills.bus.blockStore');
    Route::post('/business/data', [BusBillsManagementController::class, 'business'])->name('bills.business');
});

//route for properties
Route::group(['prefix' => 'property', 'middleware' => 'auth:sanctum'], function () {
    Route::get('/', [PropertyController::class, 'index'])->name('properties.index');
    Route::get('/create', [PropertyController::class, 'create'])->name('properties.create');
    Route::post('/', [PropertyController::class, 'store'])->name('properties.store');
    Route::post('/ratepayer', [PropertyController::class, 'ratePayerStore'])->name('properties.ratePayer');
    Route::get('/{property}', [PropertyController::class, 'show'])->name('properties.show');
    Route::get('/{property}/edit', [PropertyController::class, 'edit'])->name('properties.edit');
    Route::post('/{property}', [PropertyController::class, 'update'])->name('properties.update');
    Route::delete('/{property}', [PropertyController::class, 'destroy'])->name('properties.destroy');
    Route::get('/{property}', [PropertyController::class, 'getDetails'])->name('properties.details');
    Route::get('/citizens/search', [PropertyController::class, 'searchCitizens'])->name('citizens.search');
    Route::post('/assign-citizen', [PropertyController::class, 'assignCitizen'])->name('properties.assignCitizen');
    Route::get('/{property}', [PropertyController::class, 'show'])->name('properties.show');
    Route::post('/block/data', [PropertyController::class, 'block'])->name('ajax.block');
    Route::get('/import/data', [PropertyController::class, 'import'])->name('properties.import');
    Route::post('/import/data', [PropertyController::class, 'importData'])->name('properties.importData');
    Route::get('/template/data', [PropertyController::class, 'downloadTemplate'])->name('properties.downloadTemplate');
    Route::get('/get-all/data', [PropertyController::class, 'getAllProperties'])->name('properties.getAll');
});


//Route for propert Class Types mistakenly named it business class type
Route::group(['prefix' => 'business-class-type', 'middleware' => 'auth:sanctum'], function () {
    Route::get('/', [BusinessClassTypeController::class, 'index'])->name('business-class-types.index');
    Route::get('/create', [BusinessClassTypeController::class, 'create'])->name('business-class-types.create');
    Route::post('/', [BusinessClassTypeController::class, 'store'])->name('business-class-types.store');
    Route::get('/{businessClassType}', [BusinessClassTypeController::class, 'show'])->name('business-class-types.show');
    Route::get('/{businessClassType}/edit', [BusinessClassTypeController::class, 'edit'])->name('business-class-types.edit');
    Route::post('/{businessClassType}', [BusinessClassTypeController::class, 'update'])->name('business-class-types.update');
    Route::delete('/{businessClassType}', [BusinessClassTypeController::class, 'destroy'])->name('business-class-types.destroy');
});

//Route for Business
Route::group(['prefix' => 'business', 'middleware' => 'auth:sanctum'], function () {
    Route::get('/', [BusinessController::class, 'index'])->name('businesses.index');
    Route::get('/create', [BusinessController::class, 'create'])->name('businesses.create');
    Route::post('/', [BusinessController::class, 'store'])->name('businesses.store');
    Route::get('/{business}', [BusinessController::class, 'show'])->name('businesses.show');
    Route::get('/{business}/edit', [BusinessController::class, 'edit'])->name('businesses.edit');
    Route::post('/{business}', [BusinessController::class, 'update'])->name('businesses.update');
    Route::delete('/{business}', [BusinessController::class, 'destroy'])->name('businesses.destroy');
    Route::post('/business/class', [BusinessController::class, 'businessClass'])->name('ajax.business_class');
});

// Route for business types
Route::group(['prefix' => 'business-type', 'middleware' => 'auth:sanctum'], function () {
    Route::get('/', [BusinessTypeController::class, 'index'])->name('business-types.index');
    Route::get('/create', [BusinessTypeController::class, 'create'])->name('business-types.create');
    Route::post('/', [BusinessTypeController::class, 'store'])->name('business-types.store');
    Route::get('/{businessType}', [BusinessTypeController::class, 'show'])->name('business-types.show');
    Route::get('/{businessType}/edit', [BusinessTypeController::class, 'edit'])->name('business-types.edit');
    Route::post('/{businessType}', [BusinessTypeController::class, 'update'])->name('business-types.update');
});

// Route for business classes
Route::group(['prefix' => 'business-class', 'middleware' => 'auth:sanctum'], function () {
    Route::get('/', [BusinessClassController::class, 'index'])->name('business-classes.index');
    Route::get('/create', [BusinessClassController::class, 'create'])->name('business-classes.create');
    Route::post('/', [BusinessClassController::class, 'store'])->name('business-classes.store');
    Route::get('/{businessClass}', [BusinessClassController::class, 'show'])->name('business-classes.show');
    Route::get('/{businessClass}/edit', [BusinessClassController::class, 'edit'])->name('business-classes.edit');
    Route::post('/{businessClass}', [BusinessClassController::class, 'update'])->name('business-classes.update');
});

// Route for Customer Registration
Route::group(['prefix' => 'citizen', 'middleware' => 'auth:sanctum'], function () {
    Route::get('/', [CitizenController::class, 'index'])->name('citizens.index');
    Route::get('/create', [CitizenController::class, 'create'])->name('citizens.create');
    Route::post('/', [CitizenController::class, 'store'])->name('citizens.store');
    Route::get('/{citizen}', [CitizenController::class, 'show'])->name('citizens.show');
    Route::get('/{citizen}/edit', [CitizenController::class, 'edit'])->name('citizens.edit');
    Route::post('/{citizen}', [CitizenController::class, 'update'])->name('citizens.update');
    Route::delete('/{citizen}', [CitizenController::class, 'destroy'])->name('citizens.destroy');
    Route::get('/view/bill/{bill}', [CitizenController::class, 'viewBill'])->name('citizens.viewBill');
    Route::get('/view/property/{property}', [CitizenController::class, 'viewProperty'])->name('citizens.viewProperty');
    Route::get('/view/business/{business}', [CitizenController::class, 'viewBusiness'])->name('citizens.viewBusiness');
    Route::get('/view/payment/{payment}', [CitizenController::class, 'viewPayment'])->name('citizens.viewPayment');
    Route::get('/import/data', [CitizenController::class, 'import'])->name('citizens.import');
    Route::post('/import/data', [CitizenController::class, 'importData'])->name('citizens.importData');
    Route::get('/template/data', [CitizenController::class, 'downloadTemplate'])->name('citizens.downloadTemplate');
    Route::get('/linkproperty/data', [CitizenController::class, 'linkProperty'])->name('citizens.linkProperty');
});

// Route for Customer Types
Route::group(['prefix' => 'customer-type', 'middleware' => 'auth:sanctum'], function () {
    Route::get('/', [CustomerTypeController::class, 'index'])->name('customer-types.index');
    Route::get('/create', [CustomerTypeController::class, 'create'])->name('customer-types.create');
    Route::post('/', [CustomerTypeController::class, 'store'])->name('customer-types.store');
    Route::get('/{customerType}', [CustomerTypeController::class, 'show'])->name('customer-types.show');
    Route::get('/{customerType}/edit', [CustomerTypeController::class, 'edit'])->name('customer-types.edit');
    Route::post('/{customerType}', [CustomerTypeController::class, 'update'])->name('customer-types.update');
});

//LOGIN MANAGEMENT
Route::group(['prefix' => ''], function () {
    Route::get('/', [AuthAdmin\LoginAdminController::class, 'LandingPage'])->name('auth.LandingPage');
    Route::get('/index', [AuthAdmin\LoginAdminController::class, 'index'])->name('auth.index');
    Route::get('/register', [AuthAdmin\LoginAdminController::class, 'register'])->name('auth.register');
    Route::get('/activate', [CitizenController::class, 'activate'])->name('citizens.activate');
    Route::post('/activate', [CitizenController::class, 'activateCitizen'])->name('citizens.activateCitizen');
    Route::get('/resend/otp', [CitizenController::class, 'resend'])->name('citizens.resend');
    Route::post('/resend/otp', [CitizenController::class, 'resendOTP'])->name('citizens.resendOTP');
    Route::post('/frontstore', [CitizenController::class, 'frontstore'])->name('citizens.frontstore');
    Route::post('/login', [AuthAdmin\LoginAdminController::class, 'login'])->name('auth.login');
    Route::get('/logout', [AuthAdmin\LoginAdminController::class, 'logout'])->name('auth.logout');
    Route::get('/change/password', [AuthAdmin\LoginAdminController::class, 'change'])->name('auth.change');
    Route::post('/change/password', [AuthAdmin\LoginAdminController::class, 'changePassword'])->name('auth.changePassword');
    Route::get('/change/password/front', [AuthAdmin\LoginAdminController::class, 'changePasswordFront'])->name('auth.changePasswordFront');
    Route::post('/change/password/front', [AuthAdmin\LoginAdminController::class, 'changePasswordFrontWa'])->name('auth.changePasswordFrontWa');
    Route::get('/send/otp', [AuthAdmin\LoginAdminController::class, 'sendOTP'])->name('auth.sendOTP');
    Route::post('/send/otp', [AuthAdmin\LoginAdminController::class, 'sendUserOTP'])->name('auth.sendUserOTP');
});


//DASHBOARD
Route::group(['prefix' => 'dashboard', 'middleware' => 'auth:sanctum'], function () {
    Route::get('/operational', [Dashboard\DashboardController::class, 'operational'])->name('dashboard.operational');
    Route::get('/MyBills', [Dashboard\DashboardController::class, 'Mybills'])->name('dashboard.mybills');
    Route::get('/myprofile', [Dashboard\DashboardController::class, 'myProfile'])->name('dashboard.myprofile');
    Route::post('/myprofile/{citizen}', [Dashboard\DashboardController::class, 'updateMyProfile'])->name('dashboard.updateMyProfile');
    Route::get('/myproperties', [Dashboard\DashboardController::class, 'Myproperties'])->name('dashboard.myproperties');
    Route::get('/mybusiness', [Dashboard\DashboardController::class, 'Mybusiness'])->name('dashboard.mybusiness');
    Route::get('/mypaymenthistory', [Dashboard\DashboardController::class, 'Mypaymenthistory'])->name('dashboard.mypaymenthistory');
    Route::get('/property/analytics', [Dashboard\DashboardController::class, 'propertyAnalytic'])->name('dashboard.propertyAnalytic');
    Route::get('/nationwide/overview', [Dashboard\DashboardController::class, 'overview'])->name('dashboard.overview');
    Route::get('/payment/analytics', [Dashboard\DashboardController::class, 'paymentAnalytic'])->name('dashboard.paymentAnalytic');
    Route::get('/bill/analytics', [Dashboard\DashboardController::class, 'billAnalytic'])->name('dashboard.billAnalytic');
    Route::get('/fetch-regional-data', [Dashboard\DashboardController::class, 'fetchRegionalData'])->name('fetch.regional.data');
    Route::get('/fetch-regional-graph-data', [Dashboard\DashboardController::class, 'fetchRegionalGraphData'])->name('fetch.regional.graph.data');
    Route::get('/fetch-regional-donut-data', [Dashboard\DashboardController::class, 'fetchRegionalDonutData'])->name('fetch.regional.donut.data');
});

//USER MANAGEMENT
Route::group(['prefix' => 'user', 'middleware' => 'auth:sanctum'], function () {
    Route::get('/', [User\UserController::class, 'index'])->name('users.index');
    Route::get('/create', [User\UserController::class, 'create'])->name('users.create');
    Route::post('/', [User\UserController::class, 'store'])->name('users.store');
    Route::get('/show/{user}', [User\UserController::class, 'show'])->name('users.show');
    Route::get('/edit/{user}', [User\UserController::class, 'edit'])->name('users.edit');
    Route::post('/update/{user}', [User\UserController::class, 'update'])->name('users.update');
});

//ROLES MANAGEMENT
Route::group(['prefix' => 'role', 'middleware' => 'auth:sanctum'], function () {
    Route::get('/', [Role\RoleController::class, 'index'])->name('roles.index');
    Route::get('/create', [Role\RoleController::class, 'create'])->name('roles.create');
    Route::post('/', [Role\RoleController::class, 'store'])->name('roles.store');
    Route::get('/show/{role}', [Role\RoleController::class, 'show'])->name('roles.show');
    Route::get('/edit/{role}', [Role\RoleController::class, 'edit'])->name('roles.edit');
    Route::post('/update/{role}', [Role\RoleController::class, 'update'])->name('roles.update');
});

//PERMISSIONS MANAGEMENT
Route::group(['prefix' => 'permission', 'middleware' => 'auth:sanctum'], function () {
    Route::get('/', [Permission\PermissionController::class, 'index'])->name('permissions.index');
    Route::get('/create', [Permission\PermissionController::class, 'create'])->name('permissions.create');
    Route::post('/', [Permission\PermissionController::class, 'store'])->name('permissions.store');
    Route::get('/show/{id}', [Permission\PermissionController::class, 'show'])->name('permissions.show');
    Route::get('/edit/{id}', [Permission\PermissionController::class, 'edit'])->name('permissions.edit');
    Route::post('/update/{id}', [Permission\PermissionController::class, 'update'])->name('permissions.update');
});

//assemblies Route
Route::group(['prefix' => 'assembly', 'middleware' => 'auth:sanctum'], function () {
    Route::get('/', [AssemblyController::class, 'index'])->name('assembly.index');
    Route::get('/create', [AssemblyController::class, 'create'])->name('assembly.create');
    Route::post('/', [AssemblyController::class, 'store'])->name('assembly.store');
    Route::get('/{assembly}/edit', [AssemblyController::class, 'edit'])->name('assembly.edit');
    Route::post('/{assembly}', [AssemblyController::class, 'update'])->name('assembly.update');
    Route::delete('/{assembly}', [AssemblyController::class, 'destroy'])->name('assembly.destroy');
    Route::get('/{assembly}', [AssemblyController::class, 'show'])->name('assembly.show');
    Route::post('/fetch/data', [AssemblyController::class, 'fetchAssembly'])->name('assembly.fetch');
    Route::get('/import/data', [AssemblyController::class, 'import'])->name('assembly.import');
    Route::post('/import/data', [AssemblyController::class, 'importData'])->name('assembly.importData');
});

// Division Routes
Route::group(['prefix' => 'division', 'middleware' => 'auth:sanctum'], function () {
    Route::get('/', [DivisionController::class, 'index'])->name('divisions.index');
    Route::get('/create', [DivisionController::class, 'create'])->name('divisions.create');
    Route::post('/', [DivisionController::class, 'store'])->name('divisions.store');
    Route::get('/{division}/edit', [DivisionController::class, 'edit'])->name('divisions.edit');
    Route::post('/{division}', [DivisionController::class, 'update'])->name('divisions.update');
    Route::delete('/{division}', [DivisionController::class, 'destroy'])->name('divisions.destroy');
    Route::get('/{division}', [DivisionController::class, 'show'])->name('divisions.show');
});

// Block Routes
Route::group(['prefix' => 'block', 'middleware' => 'auth:sanctum'], function () {
    Route::get('/', [BlockController::class, 'index'])->name('blocks.index');
    Route::get('/create', [BlockController::class, 'create'])->name('blocks.create');
    Route::post('/', [BlockController::class, 'store'])->name('blocks.store');
    Route::get('/{block}/edit', [BlockController::class, 'edit'])->name('blocks.edit');
    Route::post('/{block}', [BlockController::class, 'update'])->name('blocks.update');
    Route::delete('/{block}', [BlockController::class, 'destroy'])->name('blocks.destroy');
    Route::post('/division/data', [BlockController::class, 'division'])->name('ajax.division');
    Route::get('/{block}', [BlockController::class, 'show'])->name('blocks.show');
});

//Zone Routes
Route::group(['prefix' => 'zone', 'middleware' => 'auth:sanctum'], function () {
    Route::get('/', [ZoneController::class, 'index'])->name('zones.index');
    Route::get('/create', [ZoneController::class, 'create'])->name('zones.create');
    Route::post('/create', [ZoneController::class, 'store'])->name('zones.store');
    Route::get('/{zone}/show', [ZoneController::class, 'show'])->name('zones.show');
    Route::get('/{zone}/edit', [ZoneController::class, 'edit'])->name('zones.edit');
    Route::post('/{zone}/update', [ZoneController::class, 'update'])->name('zones.update');
});

Route::group(['prefix' => 'property-user', 'middleware' => 'auth:sanctum'], function () {
    Route::get('/', [PropertyUserController::class, 'index'])->name('property-users.index');
    Route::get('/create', [PropertyUserController::class, 'create'])->name('property-users.create');
    Route::post('/create', [PropertyUserController::class, 'store'])->name('property-users.store');
    Route::get('/{propertyUser}/show', [PropertyUserController::class, 'show'])->name('property-users.show');
    Route::get('/{propertyUser}/edit', [PropertyUserController::class, 'edit'])->name('property-users.edit');
    Route::post('/{propertyUser}/update', [PropertyUserController::class, 'update'])->name('property-users.update');
});

Route::group(['prefix' => 'rate', 'middleware' => 'auth:sanctum'], function () {
    Route::get('/', [RateController::class, 'index'])->name('rates.index');
    Route::get('/create', [RateController::class, 'create'])->name('rates.create');
    Route::post('/create', [RateController::class, 'store'])->name('rates.store');
    Route::get('/{rate}/show', [RateController::class, 'show'])->name('rates.show');
    Route::get('/{rate}/edit', [RateController::class, 'edit'])->name('rates.edit');
    Route::post('/{rate}/update', [RateController::class, 'update'])->name('rates.update');
    Route::post('/property-use', [RateController::class, 'propertyUse'])->name('rates.property-use');
    Route::post('/zone/data', [RateController::class, 'zone'])->name('rates.zone');
    Route::get('/import/data', [RateController::class, 'import'])->name('rates.import');
    Route::post('/import/data', [RateController::class, 'importData'])->name('rates.importData');
    Route::get('/template', [RateController::class, 'downloadTemplate'])->name('rates.downloadTemplate');
});

Route::group(['prefix' => 'bus-rate', 'middleware' => 'auth:sanctum'], function () {
    Route::get('/', [BusRateController::class, 'index'])->name('rates.bus.index');
    Route::get('/create', [BusRateController::class, 'create'])->name('rates.bus.create');
    Route::post('/create', [BusRateController::class, 'store'])->name('rates.bus.store');
    Route::get('/{rate}/show', [BusRateController::class, 'show'])->name('rates.bus.show');
    Route::get('/{rate}/edit', [BusRateController::class, 'edit'])->name('rates.bus.edit');
    Route::post('/{rate}/update', [BusRateController::class, 'update'])->name('rates.bus.update');
    Route::get('/import/data', [BusRateController::class, 'import'])->name('rates.bus.import');
    Route::post('/import/data', [BusRateController::class, 'importData'])->name('rates.bus.importData');
    Route::get('/template', [BusRateController::class, 'downloadTemplate'])->name('rates.bus.downloadTemplate');
});

Route::group(['prefix' => 'report', 'middleware' => 'auth:sanctum'], function () {
    Route::get('/customer-report', [Report\CustomerReportController::class, 'index'])->name('customer-reports.index');
    Route::get('/business-report', [Report\BusinessReportController::class, 'index'])->name('business-reports.index');
    Route::get('/property-report', [Report\PropertyReportController::class, 'index'])->name('property-reports.index');
    Route::get('/bill-report', [Report\BillReportController::class, 'index'])->name('bill-reports.index');
    Route::get('/payment-report', [Report\PaymentReportController::class, 'index'])->name('payment-reports.index');
    Route::get('/debtors-report', [Report\DebtorsReportController::class, 'index'])->name('debtors-reports.index');
    Route::get('/agent-performance-report', [Report\Level10ReportController::class, 'agentPerformanceReport'])->name('agent-performance-reports.index');
    Route::get('/system-performance-report', [Report\Level10ReportController::class, 'systemPerformanceReport'])->name('system-peroformance-reports.index');
    Route::get('/payment-history-report', [Report\PaymentHistoryReportController::class, 'index'])->name('payment-history-reports.index');
    Route::get('/support-request-report', [Report\SupportRequestReportController::class, 'index'])->name('support-request-reports.index');
    Route::get('/tax-collection-summary-report', [Report\TaxCollectionSummaryReportController::class, 'index'])->name('tax-collection-reports.index');
    Route::get('/revenue-property-type-report', [Report\RevenuePropertyTypeReportController::class, 'index'])->name('revenue-property-type-reports.index');
    Route::get('/revenue-collection-efficiency-report', [Report\RevenueCollectionEfficiencyReportController::class, 'index'])->name('revenue-collection-efficiency-reports.index');
    Route::get('/service-usage-report', [Report\ServiceUsageReport::class, 'index'])->name('service-usage-reports.index');
    Route::get('/location-analysis-report', [Report\LocationAnalysisReportController::class, 'index'])->name('location-analysis-reports.index');
    Route::get('/audit-trail-report', [Report\AuditTrailReportController::class, 'index'])->name('audit-trail-reports.index');
    Route::get('/job-allocation-report', [Report\JobAllocationReportController::class, 'index'])->name('job-allocation-reports.index');
});

Route::group(['prefix' => 'agent-assignment', 'middleware' => 'auth:sanctum'], function () {
    Route::get('/', [AgentAssignmentController::class, 'index'])->name('agent-assignments.index');
    Route::get('/create', [AgentAssignmentController::class, 'create'])->name('agent-assignments.create');
    Route::post('/create', [AgentAssignmentController::class, 'store'])->name('agent-assignments.store');
    Route::get('/{agentAssignment}/show', [AgentAssignmentController::class, 'show'])->name('agent-assignments.show');
    Route::get('/{agentAssignment}/edit', [AgentAssignmentController::class, 'edit'])->name('agent-assignments.edit');
    Route::post('/{agentAssignment}/update', [AgentAssignmentController::class, 'update'])->name('agent-assignments.update');
});

Route::group(['prefix' => 'task-assignment', 'middleware' => 'auth:sanctum'], function () {
    Route::get('/', [TaskAssignmentController::class, 'index'])->name('task-assignments.index');
    Route::get('/create', [TaskAssignmentController::class, 'create'])->name('task-assignments.create');
    Route::post('/create', [TaskAssignmentController::class, 'store'])->name('task-assignments.store');
    Route::get('/{taskAssignment}/show', [TaskAssignmentController::class, 'show'])->name('task-assignments.show');
    Route::get('/{taskAssignment}/edit', [TaskAssignmentController::class, 'edit'])->name('task-assignments.edit');
    Route::post('/{taskAssignment}/update', [TaskAssignmentController::class, 'update'])->name('task-assignments.update');
    Route::get('/update/status', [TaskAssignmentController::class, 'updateStatus'])->name('task-assignments.updateStatus');
});

Route::group(['prefix' => 'customer-support', 'middleware' => 'auth:sanctum'], function () {
    Route::get('/', [CustomerSupportController::class, 'index'])->name('customer-supports.index');
    Route::get('/create', [CustomerSupportController::class, 'create'])->name('customer-supports.create');
    Route::post('/create', [CustomerSupportController::class, 'store'])->name('customer-supports.store');
    Route::get('/show/{customerSupport}', [CustomerSupportController::class, 'show'])->name('customer-supports.show');
    Route::get('/edit/{customerSupport}', [CustomerSupportController::class, 'edit'])->name('customer-supports.edit');
    Route::post('/update/{customerSupport}', [CustomerSupportController::class, 'update'])->name('customer-supports.update');
});

Route::group(['prefix' => 'building', 'middleware' => 'auth:sanctum'], function () {
    Route::get('/', [BuildingController::class, 'index'])->name('buildings.index');
    Route::get('/create', [BuildingController::class, 'create'])->name('buildings.create');
    Route::post('/create', [BuildingController::class, 'store'])->name('buildings.store');
    Route::get('/polygons', [BuildingController::class, 'polygons'])->name('buildings.polygons');
    Route::get('/map', [BuildingController::class, 'map'])->name('buildings.map');
    Route::get('/import', [BuildingController::class, 'importBlock'])->name('buildings.importBlock');
    Route::post('/import', [BuildingController::class, 'importBlockStore'])->name('buildings.importBlockStore');
    Route::get('/allocations/{id}', [BuildingController::class, 'allocations'])->name('buildings.allocations');
});

Route::group(['prefix' => 'mmda', 'middleware' => 'auth:sanctum'], function () {
    Route::get('/', [MmdaController::class, 'index'])->name('mmdas.index');
    Route::get('/create', [MmdaController::class, 'create'])->name('mmdas.create');
    Route::post('/create', [MmdaController::class, 'store'])->name('mmdas.store');
    Route::get('/show/{mmda}', [MmdaController::class, 'show'])->name('mmdas.show');
    Route::get('/edit/{mmda}', [MmdaController::class, 'edit'])->name('mmdas.edit');
    Route::post('/update/{mmda}', [MmdaController::class, 'update'])->name('mmdas.update');
    Route::get('/import/data', [MmdaController::class, 'import'])->name('mmdas.import');
    Route::post('/import/data', [MmdaController::class, 'importData'])->name('mmdas.importData');
});


Route::get('/test', function () {
    $payment = \App\Actions\Payment\MakePayment::acceptPayment("1", "0248593031", "MTN");

    return $payment;
});
