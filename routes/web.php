<?php

use App\Http\Controllers\CampaignController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\LeadMagnetController;
use App\Http\Controllers\OnboardingController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/onboarding', [OnboardingController::class, 'show']);
    Route::post('/onboarding', [OnboardingController::class, 'store']);

    Route::get('/lead-magnets', [LeadMagnetController::class, 'index']);
    Route::get('/lead-magnets/create', [LeadMagnetController::class, 'create']);
    Route::post('/lead-magnets', [LeadMagnetController::class, 'store']);
    Route::get('/lead-magnets/{leadMagnet}', [LeadMagnetController::class, 'show']);
    Route::delete('/lead-magnets/{leadMagnet}', [LeadMagnetController::class, 'destroy']);

    Route::get('/campaigns', [CampaignController::class, 'index']);
    Route::get('/campaigns/create', [CampaignController::class, 'create']);
    Route::post('/campaigns', [CampaignController::class, 'store']);
    Route::get('/campaigns/{campaign}', [CampaignController::class, 'show']);
    Route::patch('/campaigns/{campaign}', [CampaignController::class, 'update']);

    Route::get('/campaigns/{campaign}/contacts', [ContactController::class, 'index']);
    Route::post('/campaigns/{campaign}/contacts', [ContactController::class, 'store']);
    Route::delete('/contacts/{contact}', [ContactController::class, 'destroy']);

    Route::get('/campaigns/{campaign}/emails', [EmailController::class, 'index']);
    Route::patch('/emails/{campaignEmail}', [EmailController::class, 'update']);
    Route::post('/campaigns/{campaign}/send', [EmailController::class, 'send']);
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
