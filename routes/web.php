<?php

// Controllers
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\BorrowingController;
use App\Http\Controllers\CollectionController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\AminMiddleware;
use App\Http\Middleware\LibrarianMiddleware;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Schedule;
use Inertia\Inertia;

Schedule::command('telescope:prune --hours=48')->daily();

Route::get('/', function () {
    return Inertia::render('welcome');
})->name('home');

Route::get('dashboard', [BookController::class, 'highlight'])->name('dashboard');

Route::get('dashboard/search', [SearchController::class, 'search'])->name('dashboard.search');

Route::get('books', [BookController::class, 'index'])->name('books.index');

Route::get('books/{id}', [BookController::class, 'show'])->name('books.show');

// *USER* =====================================================================================

Route::middleware(['auth', 'verified'])->group(function () {

    Route::controller(BookController::class)->group(function () {
        Route::get('borrowings/download/{id}', 'download')->name('book.download');
    });

    Route::controller(BorrowingController::class)->group(function () {
        Route::post('/borrows/{id}', 'store')->name('borrowings.store');
        Route::get('borrowings', 'index')->name('borrowings.index');
        Route::get('borrowings/{id}', 'return')->name('borrowings.return');
    });

    Route::post('borrowings/review/{id}', [ReviewController::class, 'store'])->name('reviews.store');

    Route::post('borrowings/collect/', [CollectionController::class, 'store'])->name('collections.store');
    Route::post('borrowings/collect/{id}', [CollectionController::class, 'add'])->name('collections.add');

    Route::get('collections', [CollectionController::class, 'index'])->name('collections.index');
});

// Pustakawan> ----------------------------------------------------------------------------------
Route::middleware(['auth', 'verified', LibrarianMiddleware::class])->group(function () {

    Route::get('work', [BorrowingController::class, 'librarianIndex'])->name('librarian.borrowings.index');
    Route::get('work/borrowings/{id}', [BorrowingController::class, 'librarianDelete'])->name('librarian.borrowings.delete');

    Route::get('report', [ReportController::class, 'librarianChart'])->name('report');
    Route::get('report/download', [ReportController::class, 'librarianReport'])->name('librarian.report.download');

    Route::get('management', [BookController::class, 'librarianIndex'])->name('librarian.books.index');

    Route::get('management/import', [BookController::class, 'librarianImport'])->name('librarian.books.import');
    Route::post('/management', [BookController::class, 'librarianAdd'])->name('librarian.books.add');

    Route::get('management/books/{id}', [BookController::class, 'librarianDelete'])->name('librarian.books.delete');

    Route::get('management/{id}/edit', [BookController::class, 'librarianEdit'])->name('librarian.books.edit');
    Route::put('management/{id}', [BookController::class, 'librarianUpdate'])->name('librarian.books.update');
});
// *USER* =====================================================================================

// *Admin* ====================================================================================
Route::middleware(['auth', 'verified', AminMiddleware::class])->group(function () {
    Route::get('main', [BookController::class, 'adminMain'])->name('admin.main');
    Route::get('main/books-count', [BookController::class, 'booksCount']);

    Route::get('/crud_books', [BookController::class, 'adminIndex'])->name('admin.books.index');

    Route::get('/crud_books/import', [BookController::class, 'adminImport'])->name('admin.books.import');
    Route::post('/crud_books', [BookController::class, 'adminAdd'])->name('admin.books.add');

    Route::get('/crud_books/{id}', [BookController::class, 'adminDelete'])->name('admin.books.delete');

    Route::get('/crud_books/{id}/edit', [BookController::class, 'adminEdit'])->name('admin.books.edit');
    Route::put('/crud_books/{id}', [BookController::class, 'adminUpdate'])->name('admin.books.update');

    Route::get('/crud_borrowings', [BorrowingController::class, 'adminIndex'])->name('admin.borrowings.index');
    Route::delete('/crud_borrowings/{id}', [BorrowingController::class, 'adminDelete'])->name('admin.borrowings.delete');

    Route::get('/crud_borrowers', [UserController::class, 'adminBorrowerIndex'])->name('admin.borrowers.index');
    Route::get('/borrowers/{id}', [AuthenticatedSessionController::class, 'destroy'])->name('admin.borrowers.delete');

    Route::get('/crud_librarians', [UserController::class, 'adminLibrarianIndex'])->name('admin.librarian.index');
    Route::get('/crud_librarians/{id}', [AuthenticatedSessionController::class, 'destroy'])->name('admin.librarian.delete');
});
// *Admin* ==================================================================================

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
