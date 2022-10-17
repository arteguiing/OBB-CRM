<?php

use Illuminate\Support\Facades\Route;

use App\Http\Livewire\Auth\ForgotPassword;
use App\Http\Livewire\Auth\ResetPassword;
use App\Http\Livewire\Auth\SignUp;
use App\Http\Livewire\Auth\Login;
use App\Http\Livewire\Calendar;
use App\Http\Livewire\Dashboard;
use App\Http\Livewire\Billing;
use App\Http\Livewire\Profile;
use App\Http\Livewire\Tables;
use App\Http\Livewire\StaticSignIn;
use App\Http\Livewire\StaticSignUp;
use App\Http\Livewire\Rtl;
use App\Http\Livewire\Building;
use App\Http\Livewire\Quotation;
use App\Http\Livewire\Sitesupervisor;
use App\Models\Event;



use App\Http\Livewire\LaravelExamples\UserProfile;
use App\Http\Livewire\LaravelExamples\UserManagement;
use App\Http\Controllers\CalenderController;
use Illuminate\Http\Request;



Route::get('/sign-up', SignUp::class)->name('sign-up');
Route::get('/', Login::class)->name('login');

Route::get('/login/forgot-password', ForgotPassword::class)->name('forgot-password');

Route::get('/reset-password/{id}',ResetPassword::class)->name('reset-password')->middleware('signed');

Route::middleware('auth')->group(function () {
    Route::get('/calendar', Calendar::class)->name('calendar');

    Route::get('/company', \App\Http\Livewire\Company::class)->name('company');
    Route::post('/get_single_company', [App\Http\Controllers\Company::class, 'getCompany']);
    Route::get('/test', \App\Http\Livewire\Company::class)->name('test');

    Route::get('/building-administration', Building::class)->name('building-administration');
     Route::get('/add-project', \App\Http\Livewire\AddProject::class)->name('add-project');
     Route::get('/add-task', \App\Http\Livewire\AddTask::class)->name('add-task');
    Route::post('/save-task', [App\Http\Controllers\TaskController::class, 'saveTask']);
    Route::post('/dropzone/store', [App\Http\Controllers\TaskController::class, 'upload']);
    Route::post('/save-media', [App\Http\Controllers\TaskController::class, 'storeMedia']);
    Route::post('/load-media', [App\Http\Controllers\TaskController::class, 'loadMedia']);
    Route::get('/load-task', [App\Http\Controllers\TaskController::class, 'loadTask']);
    Route::post('/sort-task', [App\Http\Controllers\TaskController::class, 'updateOrder']);

    Route::get('/dropzone/fetch', [App\Http\Controllers\TaskController::class, 'fetch']);
    Route::get('/dropzone/delete', [App\Http\Controllers\TaskController::class, 'delete']);

    Route::get('/chart', \App\Http\Livewire\Chart::class)->name('chart');



    Route::get('fullcalender', [App\Http\Controllers\CalendarController::class, 'index']);
     Route::post('fullcalenderAjax', [App\Http\Controllers\CalendarController::class, 'ajax']);




    



    Route::get('/qoutes-budgetting', Quotation::class)->name('qoutes-budgetting');
    Route::get('/site-supervisor', Sitesupervisor::class)->name('site-supervisor');
    Route::get('/dashboard', Dashboard::class)->name('dashboard');
    Route::get('/billing', Billing::class)->name('billing');
    Route::get('/profile', Profile::class)->name('profile');
    Route::get('/tables', Tables::class)->name('tables');
    Route::get('/static-sign-in', StaticSignIn::class)->name('sign-in');
    Route::get('/static-sign-up', StaticSignUp::class)->name('static-sign-up');
    Route::get('/rtl', Rtl::class)->name('rtl');
    Route::get('/laravel-user-profile', UserProfile::class)->name('user-profile');
    Route::get('/laravel-user-management', UserManagement::class)->name('user-management');


    Route::get('/test', [App\Http\Controllers\TaskController::class, 'test']);
    
});

