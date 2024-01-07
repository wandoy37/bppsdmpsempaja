    <?php

    use App\Http\Controllers\ActivityController;
    use App\Http\Controllers\CategoryController;
    use App\Http\Controllers\DashboardController;
    use App\Http\Controllers\PostController;
    use App\Http\Controllers\SitePages;
    use App\Http\Controllers\SocialMediaController;
    use App\Http\Controllers\UserController;
    use App\Http\Controllers\VideoController;
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
    // Laravel Filemanager
    // Route::group(['prefix' => 'filemanager', 'middleware' => ['web', 'auth']], function () {
    //     \UniSharp\LaravelFilemanager\Lfm::routes();
    // });


    // Site Pages
    Route::name('site.')->group(function () {
        // Portal
        Route::get('/portal', [SitePages::class, 'portal'])->name('portal');
        // Beranda
        Route::get('/', [SitePages::class, 'index'])->name('index');
        // Berita
        Route::get('/berita', [SitePages::class, 'berita'])->name('berita');
        Route::get('/berita/{slug}', [SitePages::class, 'berita_detail'])->name('berita.detail');
        // Kategori Berita
        Route::get('/berita/category/{slug}', [SitePages::class, 'berita_category'])->name('berita.category');
        // Profile/Tentang Kami/About Us
        Route::get('/tentang-kami', [SitePages::class, 'tentang_kami'])->name('tentang.kami');
        // Mitra Kerja
        Route::get('/mitra-kerja', [SitePages::class, 'mitra_kerja'])->name('mitra.kerja');
        // Kontak
        Route::get('/kontak', [SitePages::class, 'kontak'])->name('kontak');
    });

    Route::prefix('auth')->middleware('auth')->group(function () {
        // Dashboard
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('auth.dashboard');

        // Qrcode Route
        Route::get('/qrcode', [DashboardController::class, 'qrcode_index'])->name('auth.qrcode');
        Route::get('/qrcode/create', [DashboardController::class, 'qrcode_create'])->name('auth.qrcode.create');
        Route::post('/qrcode/store', [DashboardController::class, 'qrcode_store'])->name('auth.qrcode.store');
        Route::delete('/qrcode/delete/{id}', [DashboardController::class, 'qrcode_destroy'])->name('auth.qrcode.delete');

        // Users
        Route::get('/pengguna', [UserController::class, 'index'])->name('auth.user');
        Route::get('/pengguna/create', [UserController::class, 'create'])->name('auth.user.create');
        Route::post('/pengguna/store', [UserController::class, 'store'])->name('auth.user.store');
        Route::get('/pengguna/{username}/edit', [UserController::class, 'edit'])->name('auth.user.edit');
        Route::patch('/pengguna/{username}/update', [UserController::class, 'update'])->name('auth.user.update');
        Route::delete('/pengguna/{username}/delete', [UserController::class, 'destroy'])->name('auth.user.delete');

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

        // Social Media
        Route::get('/sosial-media', [SocialMediaController::class, 'index'])->name('auth.social.media');
        Route::get('/sosial-media/{slug}/edit', [SocialMediaController::class, 'edit'])->name('auth.social.media.edit');
        Route::patch('/sosial-media/{slug}/update', [SocialMediaController::class, 'update'])->name('auth.social.media.update');

        // Video
        Route::get('/video', [VideoController::class, 'index'])->name('auth.video');
        Route::get('/video/tambah', [VideoController::class, 'create'])->name('auth.video.create');
        Route::post('/video/store', [VideoController::class, 'store'])->name('auth.video.store');
        Route::get('/video/{slug}/edit', [VideoController::class, 'edit'])->name('auth.video.edit');
        Route::patch('/video/{slug}/update', [VideoController::class, 'update'])->name('auth.video.update');
        Route::delete('/video/{slug}/delete', [VideoController::class, 'destroy'])->name('auth.video.delete');

        // Activity
        Route::get('/kegiatan', [ActivityController::class, 'index'])->name('auth.activity');
        Route::get('/kegiatan/tambah', [ActivityController::class, 'create'])->name('auth.activity.create');
        Route::post('/kegiatan/store', [ActivityController::class, 'store'])->name('auth.activity.store');
        Route::get('/kegiatan/{slug}/edit', [ActivityController::class, 'edit'])->name('auth.activity.edit');
        Route::patch('/kegiatan/{slug}/update', [ActivityController::class, 'update'])->name('auth.activity.update');
        Route::delete('kegiatan/{slug}/delete', [ActivityController::class, 'destroy'])->name('auth.activity.delete');
    });
