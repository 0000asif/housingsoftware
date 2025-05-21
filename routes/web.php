<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RentController;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\BasicController;
use App\Http\Controllers\FloorController;
use App\Http\Controllers\HouseController;
use App\Http\Controllers\IncomeController;
use App\Http\Controllers\NoticeController;
use App\Http\Controllers\RenterController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ExpenceController;
use App\Http\Controllers\RoutineController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\SyllabusController;
use App\Http\Controllers\PhonebookController;
use App\Http\Controllers\DesignationController;
use App\Http\Controllers\MonthlyRentController;
use App\Http\Controllers\PhotoGalleryController;
use App\Http\Controllers\SalaryRecordController;
use App\Http\Controllers\VideoGalleryController;
use App\Http\Controllers\PaymentMethodController;
use App\Http\Controllers\RentCollectionController;
use App\Http\Controllers\UserPermissionController;
use App\Http\Controllers\IncomeExpenceCategoryController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\BankTransactionController;
use App\Http\Controllers\RemainderController;
use App\Http\Controllers\UserStatementController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('', [AuthenticatedSessionController::class, 'create'])->name('login');
Route::post('login', [AuthenticatedSessionController::class, 'store'])->name('userlogin');

Route::get('/dashboard', function () {
    return view('admin.dashboard');
    // return view('index');
})->middleware(['auth'])->name('dashboard');

Route::middleware('auth')->group(function () {

    Route::get('newform', [BasicController::class, 'newform']);
    Route::get('datatables', [BasicController::class, 'datatables']);

    // Route::resource('category', CategoryController::class);
    // Route::get('allcategory', [CategoryController::class, 'allcategory']);
    // Route::post('updatecategory', [CategoryController::class, 'updatecategory'])->name('update.category');
    // Route::post('delete_category', [CategoryController::class, 'deletecategory'])->name('delete.category');


    // Route::resource('phonebook', PhonebookController::class);
    // Route::get('allcategory', [PhonebookController::class, 'allcategory']);
    // Route::post('updatecategory', [PhonebookController::class, 'updatecategory'])->name('update.phonebook');
    // Route::post('delete_category', [PhonebookController::class, 'deletecategory'])->name('delete.phonebook');

    Route::resource('house', HouseController::class);
    Route::resource('floor', FloorController::class);
    Route::resource('unit', UnitController::class);


    Route::get('/get-floors/{houseId}', [UnitController::class, 'getFloors'])->name('get.floors');

    Route::get('/get-due/{rentId}', [RentCollectionController::class, 'getDue'])->name('get.due');

    Route::get('/get-units/{houseId}', [UnitController::class, 'getunits'])->name('get.units');


    Route::resource('renter', RenterController::class);
    Route::get('renter/download/{file}', [RenterController::class, 'downloadPdf'])->name('renter.download');

    Route::resource('rent', RentController::class);
    Route::resource('collection', RentController::class);
    Route::resource('payment_method', PaymentMethodController::class);

    Route::resource('IEcategory', IncomeExpenceCategoryController::class);

    Route::resource('income', IncomeController::class);
    Route::resource('expence', ExpenceController::class);

    Route::resource('singleRentCollection', MonthlyRentController::class);

    Route::get('adminRentIncreaseDecrease', [RentController::class, 'IncreaseDecrease'])->name('adminRentIncreaseDecrease');
    Route::post('rent_increase_decrease', [RentController::class, 'RentIncreaseDecreaseStore'])->name('RentIncreaseDecrease.Store');

    Route::get('/rent-increase-decrease/get-renter', [RentController::class, 'getRenter'])->name('RentIncreaseDecrease.GetRenter');

    Route::get('printRentCollection/{id}', [MonthlyRentController::class, 'print'])->name('singleRentCollection.print');
    Route::post('/generate-rent', [MonthlyRentController::class, 'generateRent'])->name('generate.rent');
    Route::get('/allgenerate-rent/create', [MonthlyRentController::class, 'allrentcreate'])->name('all.rentcreate');
    Route::post('/allgenerate-rent', [MonthlyRentController::class, 'allgenerateRent'])->name('allgenerate.rent');

    Route::get('/collectionrent', [RentCollectionController::class, 'index'])->name('rentcollection.index');

    Route::get('/create/collectionrent', [RentCollectionController::class, 'create'])->name('rentcollection.create');

    Route::delete('/delete/collectionrent/{id}', [RentCollectionController::class, 'delete'])->name('rentcollection.delete');

    Route::post('/rent/collect', [RentCollectionController::class, 'collectRent'])->name('collect.rent');

    Route::get('/rentcollection/history', [RentCollectionController::class, 'history'])->name('colletion.history');
    Route::get('/rentcollection/print/{id}', [RentCollectionController::class, 'print'])->name('colletion.print');


    Route::resource('designation', DesignationController::class);
    Route::resource('employee', EmployeeController::class);
    Route::get('/renter-ledger', [UserStatementController::class, 'index'])->name('renter.ledger.index');
    Route::get('/renter-ledger/{agreementId}', [UserStatementController::class, 'show'])->name('renter.ledger.show');
    Route::get('/print-ledger/{agreementId}', [UserStatementController::class, 'print'])->name('renter.ledger.print');



    Route::resource('salary', SalaryRecordController::class);
    Route::resource('remainder', RemainderController::class);
    Route::resource('bankTransaction', BankTransactionController::class);
    Route::get('adminBankToCash', [BankTransactionController::class, 'BankToCash'])->name('banktocash');
    Route::post('bank_to_cash', [BankTransactionController::class, 'BankToCashStore'])->name('BankToCash.Store');



    // ------ salary report ---------
    Route::get('/salary-report', [ReportController::class, 'salaryreport'])->name('salary.report');

    Route::get('getsalaryreport', [ReportController::class, 'GetsalaryReport']);

    // ------ expense report ---------
    Route::get('expense-report', [ReportController::class, 'ExportReport'])->name('expense.report');
    Route::get('getexpensereport', [ReportController::class, 'GetExpenseReport']);


    // ------ Income report ---------
    Route::get('income-report', [ReportController::class, 'IncomeReport'])->name('income.report');
    Route::get('getincomereport', [ReportController::class, 'GetIncomeReport']);

    // ------ Rent Collection report ---------
    Route::get('/collection-report', [ReportController::class, 'collectionreport'])->name('collection.report');

    Route::get('getcollectionreport', [ReportController::class, 'GetcollectionReport']);

    // ------ Rent Due report ---------
    Route::get('/due-report', [ReportController::class, 'duereport'])->name('due.report');

    Route::get('getduereport', [ReportController::class, 'GetdueReport']);

    // ------ Rent Rent report ---------
    Route::get('/rent-report', [ReportController::class, 'rentreport'])->name('rent.report');
    Route::get('getrentreport', [ReportController::class, 'GetrentReport']);


    //Abdullah project Coaching management
    Route::resource('setting', SettingController::class);
    Route::resource('photo_gallery', PhotoGalleryController::class);
    Route::resource('video_gallery', VideoGalleryController::class);

    Route::resource('notice', NoticeController::class);
    Route::resource('routine', RoutineController::class);
    Route::resource('syllabus', SyllabusController::class);
});

require __DIR__ . '/auth.php';
