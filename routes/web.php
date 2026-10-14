<?php

use Illuminate\Http\Request;
use App\Http\Controllers\AuthController;

use App\Http\Controllers\PelaporController;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Lupa & Reset Kata Sandi
Route::get('/forgot-password', [AuthController::class, 'showForgotPasswordForm'])->name('password.request');
Route::post('/forgot-password', [AuthController::class, 'sendResetLink'])->name('password.email');
Route::get('/reset-password/{token}', [AuthController::class, 'showResetPasswordForm'])->name('password.reset');
Route::post('/reset-password', [AuthController::class, 'resetPassword'])->name('password.update');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        $user = auth()->user();
        $status = strtolower(trim($user->status ?? 'pelapor'));
        session(['active_role' => $status]);

        if (in_array($status, ['admin', 'sarpras', 'admin_sarpras'])) {
            return redirect()->route('admin.dashboard');
        } elseif (in_array($status, ['petugas', 'teknisi', 'staf'])) {
            return redirect()->route('petugas.dashboard');
        }

        return redirect()->route('pelapor.dashboard');
    })->name('dashboard');

    // Petugas Routes
    Route::prefix('petugas')->name('petugas.')->group(function () {
        Route::get('/dashboard', [\App\Http\Controllers\PetugasController::class, 'dashboard'])->name('dashboard');
        Route::get('/tasks/{id}', [\App\Http\Controllers\PetugasController::class, 'showTask'])->name('tasks.show');
        Route::post('/tasks/{id}/start', [\App\Http\Controllers\PetugasController::class, 'startTask'])->name('tasks.start');
        Route::post('/tasks/{id}/pause', [\App\Http\Controllers\PetugasController::class, 'pauseTask'])->name('tasks.pause');
        Route::post('/tasks/{id}/complete', [\App\Http\Controllers\PetugasController::class, 'completeTask'])->name('tasks.complete');
        Route::post('/tasks/{id}/rab', [\App\Http\Controllers\PetugasController::class, 'submitRab'])->name('tasks.rab');
    });

    // Pengaturan Keamanan & 2FA (Serta Logo & Log untuk Admin)
    Route::get('/settings/security', [\App\Http\Controllers\SecurityController::class, 'index'])->name('settings.security');
    Route::post('/admin/settings/logo', [\App\Http\Controllers\SecurityController::class, 'updateLogo'])->name('admin.settings.logo.update');
    Route::post('/admin/settings/logo/reset', [\App\Http\Controllers\SecurityController::class, 'resetLogo'])->name('admin.settings.logo.reset');

    // Notifikasi Global (Tandai Baca Semua & Per Item)
    Route::post('/notifications/mark-all-read', [\App\Http\Controllers\NotificationController::class, 'markAllRead'])->name('notifications.mark-all-read');
    Route::post('/notifications/mark-read/{id}', [\App\Http\Controllers\NotificationController::class, 'markSingleRead'])->name('notifications.mark-read');

    // Pelapor Routes
    Route::get('/pelapor/dashboard', [PelaporController::class, 'dashboard'])->name('pelapor.dashboard');
    Route::get('/pelapor/tickets', [PelaporController::class, 'tickets'])->name('pelapor.tickets');
    Route::post('/pelapor/lapor', [PelaporController::class, 'store'])->name('pelapor.lapor');
    Route::post('/pelapor/darurat', [PelaporController::class, 'storeEmergency'])->name('pelapor.darurat');
    Route::post('/pelapor/track', [PelaporController::class, 'trackTicket'])->name('pelapor.track');

    // Admin Routes
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', [\App\Http\Controllers\AdminController::class, 'dashboard'])->name('dashboard');
        Route::get('/work-orders', [\App\Http\Controllers\AdminController::class, 'workOrdersIndex'])->name('work-orders.index');
        Route::get('/work-orders/{id}', [\App\Http\Controllers\AdminController::class, 'showWorkOrder'])->name('work-orders.show');
        Route::post('/work-orders/{id}', [\App\Http\Controllers\AdminController::class, 'updateWorkOrder'])->name('work-orders.update');
        
        Route::get('/inventory', [\App\Http\Controllers\AdminController::class, 'inventoryIndex'])->name('inventory.index');
        Route::post('/inventory/facilities', [\App\Http\Controllers\AdminController::class, 'storeFacility'])->name('inventory.facilities.store');
        Route::put('/inventory/facilities/{id}', [\App\Http\Controllers\AdminController::class, 'updateFacility'])->name('inventory.facilities.update');
        Route::delete('/inventory/facilities/{id}', [\App\Http\Controllers\AdminController::class, 'destroyFacility'])->name('inventory.facilities.destroy');
        Route::post('/inventory/categories', [\App\Http\Controllers\AdminController::class, 'storeFacilityCategory'])->name('inventory.categories.store');
        
        Route::get('/technicians', [\App\Http\Controllers\AdminController::class, 'techniciansIndex'])->name('technicians.index');
        Route::post('/technicians', [\App\Http\Controllers\AdminController::class, 'storeTechnician'])->name('technicians.store');
        Route::put('/technicians/{id}', [\App\Http\Controllers\AdminController::class, 'updateTechnician'])->name('technicians.update');
        Route::delete('/technicians/{id}', [\App\Http\Controllers\AdminController::class, 'destroyTechnician'])->name('technicians.destroy');

        Route::get('/analytics', [\App\Http\Controllers\AdminController::class, 'analyticsIndex'])->name('analytics.index');
        Route::get('/analytics/export-pdf', [\App\Http\Controllers\AdminController::class, 'exportPdf'])->name('analytics.exportPdf');
        Route::get('/analytics/export-excel', [\App\Http\Controllers\AdminController::class, 'exportExcel'])->name('analytics.exportExcel');
        Route::post('/budget', [\App\Http\Controllers\AdminController::class, 'updateBudget'])->name('budget.update');

        Route::get('/rab/{id_laporan}/create', [\App\Http\Controllers\AdminController::class, 'createRab'])->name('rab.create');
        Route::post('/rab/{id_laporan}', [\App\Http\Controllers\AdminController::class, 'storeRab'])->name('rab.store');
        Route::post('/rab/{id_rab}/approve', [\App\Http\Controllers\AdminController::class, 'approveRab'])->name('rab.approve');
        Route::post('/rab/{id_rab}/reject', [\App\Http\Controllers\AdminController::class, 'rejectRab'])->name('rab.reject');
    });
});
