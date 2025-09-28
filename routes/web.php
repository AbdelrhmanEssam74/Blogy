<?php

use App\Http\Controllers\admin\AdminArticlesController;
use App\Http\Controllers\admin\AdminCategoriesController;
use App\Http\Controllers\admin\AdminDashboardController;
use App\Http\Controllers\admin\AdminSettingsController;
use App\Http\Controllers\admin\AdminUsersController;
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
Route::get('/about', [HomeController::class, 'about'])->name('about');
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');


// category routes
Route::get('/categories/{slug}', [CategoryController::class, 'index'])->name('categories.index');


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
    Route::put('/admin/articles/reject/{article_id}', [AdminArticlesController::class, 'reject'])->name('admin.article-reject');
    Route::put('/admin/articles/delete/{article_id}', [AdminArticlesController::class, 'delete'])->name('admin.article-delete');
    Route::put('/admin/articles/archive/{article_id}', [AdminArticlesController::class, 'archive'])->name('admin.article-archive');
    Route::put('/admin/articles/restore/{article_id}', [AdminArticlesController::class, 'restore'])->name('admin.article-restore');
    Route::put('/admin/articles/delete-permanently/{article_id}', [AdminArticlesController::class, 'delete_permanently'])->name('admin.article-delete-permanently');
    // filter articles
    Route::get('/admin/articles/filter', [AdminArticlesController::class, 'filter'])->name('admin.article-filter');

    // Categories's route
    Route::get('/admin/categories', [AdminCategoriesController::class, 'index'])->name('admin.categories');
    Route::get('/admin/categories/create', [AdminCategoriesController::class, 'create'])->name('admin.category-create');
    Route::post('/admin/categories/store', [AdminCategoriesController::class, 'store'])->name('admin.category-store');
    Route::get('/admin/categories/{category_id}/edit', [AdminCategoriesController::class, 'edit'])->name('admin.category-edit');
    Route::put('/admin/categories/{category_id}/update', [AdminCategoriesController::class, 'update'])->name('admin.category-update');

    // Users Management Routes
    Route::get('/admin/users', [AdminUsersController::class, 'index'])->name('admin.users');
    Route::get('/admin/users/active/{user_id}', [AdminUsersController::class, 'active'])->name('admin.users-active');
    Route::get('/admin/users/deactivate/{user_id}', [AdminUsersController::class, 'deactivate'])->name('admin.users-deactivate');
    // Admin Settings Route
    Route::get('/admin/settings', [AdminSettingsController::class, 'index'])->name('admin.settings');;
});


Route::get('/articles/create-first', [ArticleController::class, 'create_first'])->name('articles.create-first');
Route::post('/articles/create-first', [ArticleController::class, 'store'])->name('articles.store-first');

Route::get('/articles/article/{slug}', [ArticleController::class, 'show'])->name('article.view');


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
