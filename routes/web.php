<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AnalysisController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/run-migrations', function () {
    try {
        // Connect to MySQL server to ensure the database exists
        $host = config('database.connections.mysql.host', '127.0.0.1');
        $port = config('database.connections.mysql.port', '3306');
        $username = config('database.connections.mysql.username', 'root');
        $password = config('database.connections.mysql.password', '');
        $database = config('database.connections.mysql.database', 'cropeanalysis');

        $pdo = new \PDO("mysql:host={$host};port={$port}", $username, $password);
        $pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        $pdo->exec("CREATE DATABASE IF NOT EXISTS `{$database}` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;");

        // Now run the migrations and seeders
        \Illuminate\Support\Facades\Artisan::call('migrate:fresh', ['--seed' => true]);
        
        return 'MySQL Database created/verified, and migrations & seeding completed successfully!<br><pre>' . \Illuminate\Support\Facades\Artisan::output() . '</pre>';
    } catch (\Exception $e) {
        return 'Error: ' . $e->getMessage();
    }
});

Route::get('/create-storage-link', function () {
    try {
        $link = public_path('storage');
        $statusMessage = '';
        if (file_exists($link) || is_link($link)) {
            if (is_link($link)) {
                unlink($link);
                $statusMessage .= 'Removed existing symbolic link.<br>';
            } else {
                @rename($link, public_path('storage_old_' . time()));
                $statusMessage .= 'Renamed existing storage folder to avoid conflicts.<br>';
            }
        }
        
        \Illuminate\Support\Facades\Artisan::call('storage:link');
        $statusMessage .= 'Storage link created successfully!<br><pre>' . \Illuminate\Support\Facades\Artisan::output() . '</pre>';
        return $statusMessage;
    } catch (\Exception $e) {
        return 'Error creating storage link: ' . $e->getMessage();
    }
});

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
    ]);
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        $userId = auth()->id();
        $totalScans = \App\Models\Upload::where('user_id', $userId)->count();
        
        $commonDiseaseName = 'None';
        $mostCommonDisease = \App\Models\Upload::where('user_id', $userId)
            ->whereNotNull('disease_id')
            ->select('disease_id', \DB::raw('count(*) as total'))
            ->groupBy('disease_id')
            ->orderBy('total', 'desc')
            ->first();
            
        if ($mostCommonDisease && $mostCommonDisease->disease_id) {
            $disease = \App\Models\Disease::find($mostCommonDisease->disease_id);
            if ($disease) {
                $commonDiseaseName = $disease->crop_name . ' - ' . $disease->disease_name;
            }
        }
        
        $recentScans = \App\Models\Upload::where('user_id', $userId)
            ->with('disease')
            ->latest()
            ->take(5)
            ->get();

        $totalDiseases = \App\Models\Disease::count();

        return Inertia::render('Dashboard', [
            'stats' => [
                'totalScans' => $totalScans,
                'commonDisease' => $commonDiseaseName,
                'totalDiseases' => $totalDiseases,
                'lastScanDate' => $recentScans->first() ? $recentScans->first()->created_at->format('M d, Y') : 'N/A'
            ],
            'recentScans' => $recentScans
        ]);
    })->name('dashboard');

    Route::get('/analysis', [AnalysisController::class, 'index'])->name('analysis.index');
    Route::post('/analysis/upload', [AnalysisController::class, 'upload'])->name('analysis.upload');
    Route::get('/analysis/result/{id}', [AnalysisController::class, 'result'])->name('analysis.result');
    Route::get('/history', [AnalysisController::class, 'history'])->name('analysis.history');

    // Admin Diseases CRUD
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::get('/diseases', [App\Http\Controllers\Admin\DiseaseController::class, 'index'])->name('diseases.index');
        Route::post('/diseases', [App\Http\Controllers\Admin\DiseaseController::class, 'store'])->name('diseases.store');
        Route::put('/diseases/{disease}', [App\Http\Controllers\Admin\DiseaseController::class, 'update'])->name('diseases.update');
        Route::delete('/diseases/{disease}', [App\Http\Controllers\Admin\DiseaseController::class, 'destroy'])->name('diseases.destroy');
    });

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
