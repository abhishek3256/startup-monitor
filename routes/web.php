<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\StartupController;
use App\Http\Controllers\InvestorController;
use App\Http\Controllers\MilestoneController;
use App\Http\Controllers\FinancialController;
use App\Http\Controllers\InvestmentController;

Route::get('/', function () {
    return redirect()->route('dashboard');
});

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::resource('startups', StartupController::class);
Route::resource('investors', InvestorController::class);
Route::resource('milestones', MilestoneController::class);
Route::resource('financials', FinancialController::class);
Route::resource('investments', InvestmentController::class);
