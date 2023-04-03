    <?php

    use App\Http\Controllers\CategoryController;
    use App\Http\Controllers\DashboardController;
    use App\Http\Controllers\PostController;
    use Illuminate\Support\Facades\Route;

    /*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

    Route::get('/', function () {
        return view('welcome');
    });

    Route::prefix('auth')->middleware('auth')->group(function () {
        // Dashboard
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('auth.dashboard');

        // Categories
        Route::get('/kategori', [CategoryController::class, 'index'])->name('auth.category');
        Route::get('/kategori/tambah', [CategoryController::class, 'create'])->name('auth.category.create');
        Route::post('/kategori/store', [CategoryController::class, 'store'])->name('auth.category.store');
        Route::get('/kategori/{slug}/edit', [CategoryController::class, 'edit'])->name('auth.category.edit');
        Route::patch('/kategori/{slug}/update', [CategoryController::class, 'update'])->name('auth.category.update');
        Route::delete('/kategori/{slug}/delete', [CategoryController::class, 'destroy'])->name('auth.category.delete');

        // Posts
        Route::get('/postingan', [PostController::class, 'index'])->name('auth.post');
        Route::get('/postingan/tambah', [PostController::class, 'create'])->name('auth.post.create');
        Route::post('/postingan/store', [PostController::class, 'store'])->name('auth.post.store');
        Route::get('/postingan/{slug}/edit', [PostController::class, 'edit'])->name('auth.post.edit');
        Route::patch('/postingan/{slug}/update', [PostController::class, 'update'])->name('auth.post.update');
        Route::delete('/postingan/{slug}/delete', [PostController::class, 'destroy'])->name('auth.post.delete');
    });
