<?php
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ActivityController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ManageExerciseController;
use App\Http\Controllers\Admin\ManageMaterial;
use App\Http\Controllers\Admin\ReportsController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\User\ChatController;
use App\Http\Controllers\User\ExerciseController;
use App\Http\Controllers\User\MaterialController;
use App\Http\Controllers\User\NotificationController;
use App\Http\Controllers\User\ProfileController;
use App\Http\Controllers\User\ProgressController;
use App\Http\Controllers\User\StatisticsController;
use App\Http\Controllers\User\SupportController;
use App\Http\Controllers\User\CareerTestController;

// Add this line at the top of the file
Route::middleware(['web', 'auth', 'admin'])->prefix('admin')->name('admin.')->group(base_path('routes/admin.php'));

Route::get('/', function () {
    $statistics = Auth::check() ? (new StatisticsController())->getStatistics() : [];
    return view('pages.dashboard', compact('statistics'));
})->name('home');


// Rute Auth
Route::middleware('guest')->group(function () {
    Route::get('/masuk', function () {
        return view('pages.login');
    })->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
    Route::get('/daftar', function () {
        return view('pages.register');
    })->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.post');
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::prefix('profil')->name('profil.')->middleware('auth')->group(function () {
        Route::get('/', [ProfileController::class, 'index'])->name('index');
        Route::get('/edit', [ProfileController::class, 'edit'])->name('edit');
        Route::put('/update', [ProfileController::class, 'update'])->name('update');
        Route::put('/password', [ProfileController::class, 'updatePassword'])->name('password');
    });
    Route::prefix('materi')->name('materi.')->group(function () {
        Route::get('/', [MaterialController::class, 'index'])->name('index');
        Route::get('/search', [MaterialController::class, 'search'])->name('search');
        Route::get('/{id}', [MaterialController::class, 'show'])->name('show');
        Route::get('/{id}/perkenalan', [MaterialController::class, 'showIntroduction'])->name('show.introduction');
        Route::get('/{id}/materi-utama', [MaterialController::class, 'showMainContent'])->name('show.main');
        Route::get('/{id}/latihan-soal', [MaterialController::class, 'showExercise'])->name('show.exercise');
        Route::post('/{id}/complete', [MaterialController::class, 'completeContent'])->name('complete');
    });
    Route::get('/chatbot', fn() => view('pages.chatbot'))->name('chatbot');
    Route::post('/chat', [ChatController::class, 'chat'])->name('chat.send');
    Route::get('/chat/history', [ChatController::class, 'getHistory'])->name('chat.history');
    Route::post('/chat/reset', [ChatController::class, 'resetChat'])->name('chat.reset');
    // Rute tes minat bakat karir IT
    Route::get('/tes-minat-bakat', [App\Http\Controllers\User\CareerTestController::class, 'index'])->name('tes-minat-bakat');
    Route::post('/tes-minat-bakat/submit', [App\Http\Controllers\User\CareerTestController::class, 'submit'])->name('tes-minat-bakat.submit');
    Route::get('/tes-minat-bakat/result/{id}', [App\Http\Controllers\User\CareerTestController::class, 'result'])->name('tes-minat-bakat.result');
    Route::get('/tes-minat-bakat/history', [App\Http\Controllers\User\CareerTestController::class, 'history'])->name('tes-minat-bakat.history');
    Route::middleware(['auth'])->group(function () {
        Route::post('/notifikasi/{id}/mark-as-read', [NotificationController::class, 'markAsRead']);
        Route::post('/notifikasi/mark-all-as-read', [NotificationController::class, 'markAllAsRead']);
        Route::get('/notifikasi/unread-count', [NotificationController::class, 'getUnreadCount']);
        Route::get('/notifikasi', [NotificationController::class, 'index'])->name('notifikasi.index');
        Route::delete('/notifikasi/delete-all', [NotificationController::class, 'deleteAll']);
    });

});

Route::middleware(['auth.progress'])->group(function () {
    Route::get('/progres-belajar', [ProgressController::class, 'index'])->name('progress');
    Route::get('/latihan-soal', [ExerciseController::class, 'index'])->name('latihan');
    Route::get('/latihan-soal/{section}', [ExerciseController::class, 'showSection'])->name('latihan.section');
    Route::get('/latihan/{exercise}', [ExerciseController::class, 'show'])->name('latihan.show');
    Route::post('/latihan/{exercise}/complete', [ExerciseController::class, 'completeExercise'])->name('latihan.complete');
});



Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::resource('users', UserController::class);
    Route::resource('materials', ManageMaterial::class);
    Route::post('/materials/{material}/toggle-status', [ManageMaterial::class, 'toggleStatus'])->name('materials.toggle-status');
    Route::get('activities', [ActivityController::class, 'index'])->name('activities.index');
    Route::get('activities/data', [ActivityController::class, 'getActivities'])->name('activities.data');
    Route::resource('exercises', ManageExerciseController::class);
    Route::patch('/exercises/{exercise}/toggle-status', [ManageExerciseController::class, 'toggleStatus'])->name('exercises.toggle-status');
    Route::get('/exercises/{exercise}/data', [ManageExerciseController::class, 'getData'])->name('exercises.data');
    Route::get('reports', [ReportsController::class, 'index'])->name('reports');
    Route::get('reports/monthly-stats', [ReportsController::class, 'getMonthlyStats'])->name('reports.monthly-stats');
    
    // Rute manajemen tes minat bakat
    Route::get('/career-test', [App\Http\Controllers\Admin\CareerTestController::class, 'index'])->name('career-test.index');
    Route::get('/career-test/{id}', [App\Http\Controllers\Admin\CareerTestController::class, 'show'])->name('career-test.show');
    Route::delete('/career-test/{id}', [App\Http\Controllers\Admin\CareerTestController::class, 'destroy'])->name('career-test.destroy');
    Route::get('/career-test-statistics', [App\Http\Controllers\Admin\CareerTestController::class, 'statistics'])->name('career-test.statistics');
});

// Debug routes - only accessible in local environment
if (app()->environment('local')) {
    Route::prefix('debug')->middleware(['auth', 'admin'])->group(function () {
        Route::get('/images', [App\Http\Controllers\Admin\DebugController::class, 'checkImages']);
        Route::get('/fix-storage', [App\Http\Controllers\Admin\DebugController::class, 'fixStorageLink']);
    });
}



// untuk admin
Route::get('/admin/materials', [ManageMaterial::class, 'index'])->name('admin.materials.index');

// atau untuk user
Route::get('/materi', [MaterialController::class, 'index'])->name('materi.index');