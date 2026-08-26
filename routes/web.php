<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\RecipeController;
use App\Http\Controllers\FeaturedController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\AdController;
use App\Http\Controllers\LicenseController;
use App\Http\Controllers\AppConfigController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\PrivacyPolicyController;
use App\Http\Controllers\Api\RecipeApiController;



Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('categories', CategoryController::class);
    Route::resource('recipes', RecipeController::class);

    Route::get('/featured', [FeaturedController::class, 'index'])->name('featured.index');
    Route::get('/featured/{recipe}/add', [FeaturedController::class, 'add'])->name('featured.add');
    Route::get('/featured/{recipe}/remove', [FeaturedController::class, 'remove'])->name('featured.remove');

    Route::get('/settings', [SettingController::class, 'index'])->name('settings.index');
    Route::post('/settings', [SettingController::class, 'update'])->name('settings.update');

    Route::get('/ads', [AdController::class, 'index'])->name('ads.index');
    Route::post('/ads', [AdController::class, 'update'])->name('ads.update');
    Route::get('/ads/placement/{field}/toggle', [AdController::class, 'togglePlacement'])->name('ads.placement.toggle');

    Route::get('/license', [LicenseController::class, 'index'])->name('license.index');
    Route::get('/license/edit', [LicenseController::class, 'edit'])->name('license.edit');
    Route::post('/license', [LicenseController::class, 'update'])->name('license.update');
    Route::post('/license/revoke', [LicenseController::class, 'revoke'])->name('license.revoke');

    Route::get('/apps', [AppConfigController::class, 'index'])->name('apps.index');
    Route::get('/apps/create', [AppConfigController::class, 'create'])->name('apps.create');
    Route::post('/apps', [AppConfigController::class, 'store'])->name('apps.store');
    Route::get('/apps/{app}/edit', [AppConfigController::class, 'edit'])->name('apps.edit');
    Route::put('/apps/{app}', [AppConfigController::class, 'update'])->name('apps.update');
    Route::get('/apps/{app}/delete', [AppConfigController::class, 'destroy'])->name('apps.destroy');

    Route::get('/administrators', [AdminController::class, 'index'])->name('admins.index');
    Route::get('/administrators/create', [AdminController::class, 'create'])->name('admins.create');
    Route::post('/administrators', [AdminController::class, 'store'])->name('admins.store');
    Route::get('/administrators/{admin}/edit', [AdminController::class, 'edit'])->name('admins.edit');
    Route::put('/administrators/{admin}', [AdminController::class, 'update'])->name('admins.update');
    Route::get('/administrators/{admin}/delete', [AdminController::class, 'destroy'])->name('admins.destroy');

    Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');
    Route::get('/notifications/create', [NotificationController::class, 'create'])->name('notifications.create');
    Route::post('/notifications', [NotificationController::class, 'store'])->name('notifications.store');
    Route::get('/notifications/{notification}/edit', [NotificationController::class, 'edit'])->name('notifications.edit');
    Route::put('/notifications/{notification}', [NotificationController::class, 'update'])->name('notifications.update');
    Route::get('/notifications/{notification}/delete', [NotificationController::class, 'destroy'])->name('notifications.destroy');
    Route::get('/notifications/{notification}/send', [NotificationController::class, 'showSend'])->name('notifications.send.form');
    Route::post('/notifications/{notification}/send', [NotificationController::class, 'send'])->name('notifications.send');

    Route::get('/settings/api-key', [SettingController::class, 'changeApiKey'])->name('settings.api-key');
    Route::get('/settings/api-key/generate', [SettingController::class, 'generateApiKey'])->name('settings.api-key.generate');
    Route::post('/settings/api-key', [SettingController::class, 'updateApiKey'])->name('settings.api-key.update');

    Route::get('/privacy', [PrivacyPolicyController::class, 'show'])->name('privacy.show');



});
