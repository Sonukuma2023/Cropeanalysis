Write-Host "1. Removing fake artisan file..." -ForegroundColor Cyan
Remove-Item artisan -ErrorAction SilentlyContinue

Write-Host "1.5 Cleaning previous temp folder..." -ForegroundColor Cyan
Remove-Item "cropeanalysis_temp" -Recurse -Force -ErrorAction SilentlyContinue

Write-Host "2. Creating fresh Laravel project in temporary folder..." -ForegroundColor Cyan
composer create-project laravel/laravel cropeanalysis_temp

Write-Host "3. Merging Laravel files with our custom code..." -ForegroundColor Cyan
# Copy all regular files and folders
Copy-Item "cropeanalysis_temp\*" ".\" -Recurse -Force
# Copy hidden files like .env and .gitignore
Copy-Item "cropeanalysis_temp\.env*" ".\" -Force
Copy-Item "cropeanalysis_temp\.git*" ".\" -Force

Write-Host "4. Cleaning up temp folder..." -ForegroundColor Cyan
Remove-Item "cropeanalysis_temp" -Recurse -Force

Write-Host "5. Restoring our custom routes..." -ForegroundColor Cyan
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

Write-Host "6. Installing Laravel Breeze for Vue..." -ForegroundColor Cyan
composer require laravel/breeze --dev
php artisan breeze:install vue

Write-Host "7. Installing Node dependencies..." -ForegroundColor Cyan
npm install

Write-Host "======================================================" -ForegroundColor Green
Write-Host "✅ Setup Complete!" -ForegroundColor Green
Write-Host "You can now safely run: npm run dev" -ForegroundColor Green
Write-Host "And in another terminal: php artisan serve" -ForegroundColor Green
Write-Host "======================================================" -ForegroundColor Green
