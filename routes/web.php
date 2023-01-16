<?php

use Illuminate\Support\Facades\Route;
use Spatie\Permission\Contracts\Role;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RequestController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\UserRequestController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\ChartController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ReportDeptController;
use App\Http\Controllers\user\UserController as UserUserController;
use App\Http\Controllers\WaController;

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

Route::get('/', function () {
    return view('auth.login');
});

//Group route login
Route::group(['middleware'=>'auth'], function(){

    //dashboard
    Route::get('/dashboard',[DashboardController::class, 'index'] )->name('dashboard');

    Route::get('/timeline', function(){
        return view('admin.timeline');
    });

    Route::get('/getrelevant', [RequestController::class, 'getRelevant']);

    //role admin
    Route::middleware(['role:admin'])->name('admin.')->prefix('admin')->group(function(){
        Route::get('/', [IndexController::class, 'IndexController@index'])->name('index');
        Route::resource('/permissions', PermissionController::class);
        Route::resource('/roles', RoleController::class);
        Route::post('role/{role}/permissions', [RoleController::class, 'givePermission'])->name('roles.permissions');
        Route::delete('role/{role}/permissions/{permission}', [RoleController::class, 'revokePermission'])->name('roles.permissions.revoke');
        Route::post('/permissions/{permission}/roles',[PermissionController::class, 'assignRole'])->name('permissions.role');
        Route::delete('/permissions/{permission}/roles/{role}',[PermissionController::class, 'removeRole'])->name('permissions.roles.remove');
        Route::get('/manage_users',[UserController::class,'index'])->name('manage_user.index');
        Route::get('/report', [ReportController::class,'index'])->name('report.index');
        Route::get('/report/{date}/week/', [ReportController::class, 'detailWeek'])->name('report.week');
        Route::get('/report/{date}/month/', [ReportController::class, 'detailMonth'])->name('report.month');
        Route::get('/feedback', [FeedbackController::class, 'index'])->name('feedback');
        Route::resource('/user', UserUserController::class);

        //export
        Route::get('export/tenant',[ReportController::class,'month_export_tenant'])->name('export_month');
    });

    //role tenant
    Route::middleware(['role:tenant'])->name('request.')->prefix('request')->group(function(){
        Route::resource('/', RequestController::class);
        Route::get('{id}/timeline', [RequestController::class, 'timeline'])->name('timeline');
        Route::get('/list', [RequestController::class, 'getMyRequest'])->name('list');
        Route::post('add_rate',[RequestController::class,'storeRating'])->name('rating');
        Route::post('verify',[RequestController::class,'verify'])->name('verify');
        Route::post('rate_us',[RequestController::class,'rateUs'])->name('rateus');
    });

    //role adalah user / department biie
    Route::middleware(['role:user'])->name('department.')->prefix('department')->group(function(){
        Route::resource('/', UserRequestController::class);
        Route::get('{id}/addresponse', [UserRequestController::class, 'addResponse'])->name('addresponse');
        Route::get('{id}/addprogress', [UserRequestController::class, 'addProgress'])->name('addprogress');
        Route::post('create', [UserRequestController::class, 'create'])->name('create_response');
        Route::post('store_progress', [UserRequestController::class, 'storeProgress'])->name('create_progress');
        Route::post('finish', [UserRequestController::class, 'finish'])->name('finish');
        Route::post('cancel',[UserRequestController::class, 'cancelRequest'])->name('cancel');
        Route::get('{id}/timeline', [RequestController::class, 'timeline'])->name('timeline');

        Route::get('dept-chart', [ReportDeptController::class, 'index'])->name('dept.chart');

    });
    
    Route::resource('/profile', ProfileController::class);
    Route::post('update_password',[ProfileController::class, 'updatePassword'])->name('update_pass');

    Route::get('/chart', [ChartController::class, 'index'])->name('chart');
    Route::get('/wa', [WaController::class, 'index'])->name('wa');
});




Route::get('/manage_request', function(){
    return view('admin.request');
});


require __DIR__.'/auth.php';
