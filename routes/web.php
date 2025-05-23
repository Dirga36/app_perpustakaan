<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\BookController;
// Controllers
use App\Http\Controllers\BorrowingController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('borrowings/{id}', [BookController::class, 'download'])->name('book.download');

// *USER* =====================================================================================
Route::get('/', function () {
    return Inertia::render('welcome');
})->name('home');

// Peminjam< ------------------------------------------------------------------------------------
Route::middleware(['auth', 'verified'])->group(function () {

    Route::get('dashboard', function () {
        return Inertia::render('dashboard');
    })->name('dashboard');

    // This GET route uses a different URI, so no conflict:
    Route::get('daftar_buku', [BookController::class, 'index'])->name('book.index');

    Route::get('daftar_buku/pinjam_buku/{id}', [BookController::class, 'show'], [ReviewController::class, 'index'])->name('book.show');

    // POST route for borrowing a book
    Route::controller(BorrowingController::class)->group(function () {
        Route::post('pinjam_buku', 'store')->name('borrow.store');
        Route::post('/detail_buku', 'store')->name('borrow.store');
    });

    Route::get('borrowings', [BorrowingController::class, 'index'], [ReviewController::class, 'store'])->name('borrow.index');

    Route::get('/detail_buku/{id}', [BookController::class, 'detail'])->name('book.detail');
    Route::get('/detail_buku2/{id}', [BookController::class, 'detail2'])->name('book.detail2');
    Route::get('/detail_buku3/{id}', [BookController::class, 'detail3'])->name('book.detail3');
});

// Pustakawan> ----------------------------------------------------------------------------------
Route::middleware(['auth', 'verified'])->group(function () {

    Route::get('work', [BorrowingController::class, 'librarian_index'])->name('work');

    Route::get('laporan', function () {
        return Inertia::render('librarian/laporan');
    })->name('laporan');
    Route::get('laporan/download', [LaporanController::class, 'report_index'])->name('report.download');

    Route::get('pendataan', [BookController::class, 'librarian_book_index'])->name('pendataan');
    Route::put('pendataan/{id}', [BookController::class, 'update'])->name('crud_book.update');
});

// *USER* ====================================================================================

// *Admin* ==================================================================================
Route::middleware(['auth', 'verified'])->group(function () {

    Route::get('main', [BookController::class, 'chart'])->name('main');

    Route::get('crud_buku', [BookController::class, 'crud_book_index'])->name('crud_book.index');

    Route::post('crud_buku/import', [BookController::class, 'import'])->name('crud_book.import');

    Route::get('crud_buku/{id}', [BookController::class, 'crud_remove'])->name('crud_book.remove');

    Route::get('/{id}/edit', [BookController::class, 'edit'])->name('crud_book.edit');
    Route::put('crud_buku/{id}', [BookController::class, 'update'])->name('crud_book.update');

    Route::get('crud_peminjaman', [BorrowingController::class, 'crud_index'])->name('crud_borrowing.index');
    Route::get('crud_peminjaman/{id}', [BorrowingController::class, 'crud_remove'])->name('crud_borrowing.remove');

    Route::get('crud_pustakawan', [UserController::class, 'crud_pustakawan_index'])->name('librarian.index');
    Route::get('crud_pustakawan/{id}', [AuthenticatedSessionController::class, 'destroy'])->name('librarian.remove');

    Route::get('crud_peminjam', [UserController::class, 'crud_peminjam_index'])->name('crud_borrower');
    Route::get('crud_peminjam/{id}', [AuthenticatedSessionController::class, 'destroy'])->name('borrower.remove');
});
// *Admin* ==================================================================================

require __DIR__ . '/settings.php';
require __DIR__ . '/auth.php';
