<?php

use App\Http\Controllers\admin\AccountPayController;
use App\Http\Controllers\Admin\AccountRecController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\BudgetController;
use App\Http\Controllers\Admin\DatabaseController;
use App\Http\Controllers\Admin\ExpenseController;
use App\Http\Controllers\Admin\IncomeController;
use App\Http\Controllers\Admin\OfficerController;
use App\Http\Controllers\Admin\ParameterController;
use App\Http\Controllers\Admin\SalaryController;
use App\Http\Controllers\Admin\SettingController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|

  $2y$10$Za5hEluO6q5/OingWozD.urJXV...R2SllR6enL3wQRSHFZOD3CYG
  
*/

## Make login page as default page
Route::get('/', function () {
    return redirect(route('login'));
});

Route::group(['prefix' => 'admin', 'middleware' => ['auth:sanctum'], config('jetstream.auth_session'), 'verified'], function() {
    ## Dashboard section
    Route::get('/dashboard.html', [AdminController::class, 'dashBoard'])->name('admin.dashboard');
});

## Setting Controller
Route::controller(SettingController::class)->group(function(){

    // user route 
    Route::get('/usercreate', 'usercreate')->name('admin.usercreate');
    Route::post('/usercreate', 'userinsert')->name('admin.usercreate');
    Route::get('/userpermission','userpermission')->name('admin.userpermission');

    // role route 
    Route::get('/rolecreate','rolecreate')->name('admin.rolecreate');
    Route::post('/roleinsert','roleinsert')->name('admin.roleinsert');
    Route::get('/roleassign','roleassign')->name('admin.roleassign');
    Route::post('/roleassign','permission')->name('admin.roleassign');
});


## Income controller route 
Route::controller(IncomeController::class)->group(function(){
    Route::get('/admin/income','index')->name('admin.income');
    Route::post('/admin/income','entry')->name('admin.income');

    Route::get('/admin/income/report','report')->name('admin.income.report');
    Route::post('/admin/income/report','reportSearch')->name('admin.income.report');
    ##Route::post('/admin/income/report','searchReport')->name('admin.income.report');

    Route::get('/admin/income/todayreport','todayreport')->name('admin.income.todayreport');
    Route::get('/admin/income/monthreport','monthreport')->name('admin.income.monthreport');


});

## Expense controller Route 
Route::controller(ExpenseController::class)->group(function(){
    Route::get('/admin/expense','index')->name('admin.expense');
    Route::post('/admin/expense','entry')->name('admin.expense');

    Route::get('/admin/expense/report','report')->name('admin.expense.report');
    Route::post('/admin/expense/report','serachReport')->name('admin.expense.report');

    Route::get('/admin/expense/total_amount','total_amount')->name('admin.expense.total_amount');
});


##salary controller 
Route::controller(SalaryController::class)->group(function(){
    Route::get('/admin/salary','salary_index')->name('admin.salary');
    Route::post('/admin/salary','salary_insert')->name('admin.salary');
    Route::get('/admin/salary/edit/{id}','salary_edit')->name('admin.salary.edit');
    Route::post('/admin/salary/update','salary_update')->name('admin.salary.update');
    
    Route::get('/admin/salary/salaryMonth','salaryMonth')->name('admin.salary.salaryMonth');
    Route::get('/admin/salary/salaryAmount','salaryAmount')->name('admin.salary.salaryAmount');

    Route::get('/admin/salary/generate','generate')->name('admin.salary.generate');
});


## officer controller
Route::controller(OfficerController::class)->group(function(){
    Route::get('/admin/officer','officer_index')->name('admin.officer');
    Route::post('/admin/officer','officer_insert')->name('admin.officer');
    Route::get('/admin/officer/delete/{id}','delete')->name('admin.officer.delete');

});


## parameter controller route 
Route::controller(ParameterController::class)->group(function(){
    Route::get('/admin/cashinhand','cash_index')->name('admin.cashinhand');
    Route::post('/admin/cashinhand','cash_insert')->name('admin.cashinhand');

    Route::get('/admin/glhead','gl_index')->name('admin.glhead');
    Route::post('/admin/glhead','gl_insert')->name('admin.glhead');

    Route::get('/admin/clientname','client_index')->name('admin.clientname');
    Route::post('/admin/clientname','client_insert')->name('admin.clientname');
});

## Budget controller 
Route::controller(BudgetController::class)->group(function(){
    Route::get('/admin/budgetchange','budgetchange')->name('admin.budgetchange');
    Route::post('/admin/budgetupdate','budgetupdate')->name('admin.budgetupdate');

    Route::get('/admin/budgetreport','report_search')->name('admin.budgetreport');
    Route::post('/admin/budgetreport','report_view')->name('admin.budgetreport');
});

##Account Receivable
Route::controller(AccountRecController::class)->group(function(){
    Route::get('/admin/accountreceivale','accountreceivale')->name('admin.accountreceivale');
    Route::post('/admin/accountreceivale','accountinsert')->name('admin.accountreceivale');

    Route::get('/admin/accountRecUpdate','accountRecUpdate')->name('admin.accountRecUpdate');

    Route::get('/admin/accountrecreport','accountrecreport')->name('admin.accountrecreport');
});


##Account Payable
Route::controller(AccountPayController::class)->group(function(){
    Route::get('/admin/accountpayable','accountpayable')->name('admin.accountpayable');
    Route::post('/admin/accountpayable','accountinsert')->name('admin.accountpayable');

    Route::get('/admin/accountPayUpdate','accountPayUpdate')->name('admin.accountPayUpdate');

    Route::get('/admin/accountrecreport','accountrecreport')->name('admin.accountrecreport');
});


Route::get('/admin/database/backup',[DatabaseController::class,'backup'])->name('admin.database.backup');


// Route::get('/admin/income',function(){
//     return "sldkfja";
// });