<?php

use App\Http\Controllers\BannerController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\SettingAppController;
use App\Http\Controllers\UserController;
use App\Models\Banner;
use App\Models\Berita;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

// Route::inertia('/','Frontend/Home')->name('home');
Route::get('/',function(Request $request){
    $kategori = Kategori::where('isActive',1)->latest()->get();
    $banner = Banner::where('isPublish',1)->latest()->get();
    $berita = Berita::where('isPublish',1)
    ->when($request->search,function($q)use($request){
        $q->where('judul','like','%'.$request->search.'%');
    })
    ->with(['kategori', 'user'])
    ->latest()
    ->limit(9)
    ->get();
    return Inertia::render('Frontend/Home',[
        'banner' => $banner,
        'berita' => $berita,
        'kategori' => $kategori,
    ]);
})->name('home');

Route::get('/kategori/{slug}',function($slug){
    $kategori = Kategori::where('slug',$slug)->first();
    $berita = Berita::whereHas('kategori',function($q)use($slug){
        $q->where('slug',$slug);
    })
    ->with(['kategori','user'])
    ->get();

    return Inertia::render('Frontend/Kategori',[
        'berita' => $berita,
        'kategori' => $kategori,
    ]);
})->name('kategori');

Route::get('/berita/{slug}', function ($slug) {

    $berita = Berita::where('slug',$slug)
        ->with(['kategori', 'user'])
        ->first();
    $berita->diklik = $berita->diklik+1;
    $berita->save();

    $beritaTerkait = Berita::whereNot('slug', $slug)
        ->where('kategori_id',$berita->kategori_id)
        ->with(['kategori', 'user'])
        ->orderBy('created_at','desc')
        ->limit(5)
        ->get();

    return Inertia::render('Frontend/Berita', [
        'berita' => $berita,
        'beritaTerkait' => $beritaTerkait,
    ]);
})->name('berita');

Route::get('/login', function () {
    return Inertia::render('Login');
})->name('login');

Route::middleware('guest')->group(function () {
    Route::inertia('/register', 'Register')->name('register');
    Route::post('/register', [LoginController::class, 'register']);

    Route::inertia('/login', 'Login')->name('login');
    Route::post('/login', [LoginController::class, 'login']);
});

Route::middleware('auth')->group(
    function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        Route::resource('/setting', SettingAppController::class);
        Route::resource('/banner', BannerController::class);
        Route::resource('/user', UserController::class);

        Route::resource('/kategori', KategoriController::class);
        Route::resource('/berita', BeritaController::class);
        Route::get('/berita/publishUpdate/{id}',[BeritaController::class,'publishUpdate'])->name('berita.publishUpdate');

        Route::inertia('/profile','UserProfile')->name('profile');

        Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
    }
);
