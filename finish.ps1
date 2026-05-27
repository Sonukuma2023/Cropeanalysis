Write-Host "1. Installing Laravel Breeze for Vue (bypassing scripts to prevent crashes)..." -ForegroundColor Cyan
composer require laravel/breeze --dev --no-scripts
php artisan breeze:install vue

Write-Host "2. Restoring custom routes..." -ForegroundColor Cyan
$customRoutes = @"
<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AnalysisController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');

    Route::get('/analysis', [AnalysisController::class, 'index'])->name('analysis.index');
    Route::post('/analysis/upload', [AnalysisController::class, 'upload'])->name('analysis.upload');
    Route::get('/analysis/result/{id}', [AnalysisController::class, 'result'])->name('analysis.result');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
"@
Set-Content -Path "routes\web.php" -Value $customRoutes -Encoding UTF8

Write-Host "3. Installing Javascript dependencies (this fixes 'vite is not recognized')..." -ForegroundColor Cyan
npm install

Write-Host "✅ Done! You can now run: npm run dev" -ForegroundColor Green
