<?php

use App\Http\Controllers\BookingController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
//use App\Http\Controllers\Admin\DashboardController;
# Livewire
use App\Livewire\Counter;
use App\Http\Controllers\Inference\InferenceController;
#
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ScheduledClassController;
#
use Illuminate\Support\Facades\DB; 

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get('/', function () {
    return view('welcome');
});

//Route::get('/counter', Counter::class);
//Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth'])->name('dashboard'); 

Route::get('/dashboard',DashboardController::class)->middleware(['auth'])->name('dashboard');

Route::get('/admin/dashboard',function () {
    return view('admin.dashboard');
})->middleware(['auth','role:admin'])->name('admin.dashboard'); 

Route::get('/instructor/dashboard',function () {
    return view('instructor.dashboard');
})->middleware(['auth','role:instructor'])->name('instructor.dashboard'); 

Route::resource('instructor/schedule',ScheduledClassController::class )
->only(['index','create','store','destroy'])
->middleware(['auth','role:instructor']);

// Route::get('/member/dashboard',function () {
//     return view('member.dashboard');
// })->middleware(['auth','role:member'])->name('member.dashboard'); 

// Route::get('/member/book',[BookingController::class,'create'])->middleware(['auth','role:member'])->name('booking.create');

// Member routes
Route::middleware(['auth','role:member'])->group(function () {

    Route::get('/member/dashboard',function () {
        return view('member.dashboard');
    })->name('member.dashboard'); 

    Route::get('/member/book',[BookingController::class,'create'])->name('booking.create');
    Route::post('/member/bookings',[BookingController::class,'store'])->name('booking.store');
    Route::get('/member/bookings',[BookingController::class,'index'])->name('booking.index');
    Route::delete('/member/bookings/{id}',[BookingController::class,'destroy'])->name('booking.destroy');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/test-db', function () {
    $driver = config('database.default');
    if ($driver === 'sqlite') {
        $version = DB::select('SELECT sqlite_version() AS version');
        return response()->json(['database' => 'SQLite', 'version' => $version[0]->version]);
    } elseif ($driver === 'mysql') {
        $version = DB::select('SELECT VERSION() AS version');
        return response()->json(['database' => 'MySQL', 'version' => $version[0]->version]);
    } else {
        return response()->json(['error' => 'Unsupported database type']);
    }
});

require __DIR__.'/auth.php';
