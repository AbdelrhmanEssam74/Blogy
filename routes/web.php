<?php

use App\Http\Controllers\admin\AdminArticlesController;
use App\Http\Controllers\admin\AdminDashboardController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\writer\WriterDashboardController;
use App\Http\Controllers\writer\WriterArticleController;
use App\Http\Controllers\writer\WriterProfileController;
use App\Http\Middleware\CheckAdminRole;
use App\Http\Middleware\checkAuthentication;
use App\Http\Middleware\CheckWriterRole;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/articles', [ArticleController::class, 'index'])->name('articles.index');


// writer routes
Route::middleware([checkAuthentication::class, CheckWriterRole::class])->group(function () {
    Route::get('/writer', [WriterDashboardController::class, 'index'])->name('writer.dashboard');
    Route::get('/writer/dashboard', [WriterDashboardController::class, 'index'])->name('writer.dashboard');
    // Article Routes
    Route::get('/writer/articles', [WriterArticleController::class, 'index'])->name('writer.articles');
    Route::get('/writer/create', [WriterArticleController::class, 'create'])->name('writer-article.create');
    Route::post('/writer/store', [WriterArticleController::class, 'store'])->name('writer-article.store');
    Route::get('/writer/article/{slug}', [WriterArticleController::class, 'view_article'])->name('writer.view_article');
    Route::get('/writer/article/edit/{id}', [WriterArticleController::class, 'edit'])->name('writer.edit_article');
    Route::put('/writer/article/update/{id}', [WriterArticleController::class, 'update'])->name('writer-article.update');
    Route::delete('/writer/article/delete/{id}', [WriterArticleController::class, 'delete'])->name('writer.article-delete');
    // Profile Routes
    Route::get('/writer/profile', [WriterProfileController::class, 'index'])->name('writer.profile');
    Route::patch('/writer/profile/update', [WriterProfileController::class, 'profileUpdate'])->name('writer.profile.update');
    Route::patch('/writer/account/update', [WriterProfileController::class, 'accountUpdate'])->name('writer.account.update');
    Route::patch('/writer/security/update', [WriterProfileController::class, 'securityUpdate'])->name('writer.security.update');
});

//Admin Routes
Route::middleware([checkAuthentication::class, CheckAdminRole::class])->group(function () {
    Route::get('/admin', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('/admin/articles', [AdminArticlesController::class, 'index'])->name('admin.articles');
    Route::get('/admin/article/{slug}', [AdminArticlesController::class, 'show'])->name('admin.article-show');
    // articles management
    Route::put('/admin/articles/approve/{article_id}', [AdminArticlesController::class, 'approve'])->name('admin.article-approve');
});

Route::get('/articles/create', [ArticleController::class, 'create'])->name('articles.create');
Route::get('/articles/create-first', [ArticleController::class, 'create_first'])->name('articles.create-first');
Route::post('/articles/create-first', [ArticleController::class, 'store'])->name('articles.store-first');
Route::post('/articles', [ArticleController::class, 'store'])->name('articles.store');

Route::get('/articles/delete/{id}', [ArticleController::class, 'delete'])->name('articles.delete');
Route::get('/articles/{slug}', [ArticleController::class, 'show'])->name('articles.show');

Route::get('/articles/edit/{id}', [ArticleController::class, 'edit'])->name('articles.edit');
Route::put('/articles/{article:slug}', [ArticleController::class, 'update'])->name('articles.update');


Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
Route::get('/categories/create', [CategoryController::class, 'create'])->name('categories.create');
Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');
Route::get('/categories/{category}', [CategoryController::class, 'show'])->name('categories.show');


Route::get('/categories/{category}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
Route::put('/categories/{category}', [CategoryController::class, 'update'])->name('categories.update');
Route::delete('/categories/{category}', [CategoryController::class, 'destroy'])->name('categories.destroy');


Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
});

Route::post('/comments', [CommentController::class, 'store'])->name('comments.store')->middleware('auth');
Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');
Route::put('/comments/{id}', [CommentController::class, 'update'])->name('comments.update');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
