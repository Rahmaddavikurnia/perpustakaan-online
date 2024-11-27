<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\SesiController;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\GenerateController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KategoribukuController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\PengembalianController;
use App\Models\Buku;
use App\Models\Kategoribuku;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {
//     return view('welcome');
// });


Route::controller(SesiController::class)->group(function () {
    Route::middleware(['checkRole:admin'])->group(function () {
        Route::get('/user', 'userindex')->name('user.index');
        Route::get('/user-create', 'usercreate')->name('createuser');
        Route::post('/user-createpost', 'userstore')->name('createpost');
        Route::get('/user-update/{users}', 'useredit')->name('updateuser');
        Route::patch('/user-update/{users}', 'userupdate')->name('updatepost');
        Route::delete('/user-delete/{users}', 'userdelete')->name('deleteuser');
    });
    Route::middleware('guest')->group(function () {
        Route::get('/', 'login')->name('login');
        Route::post('/loginpost', 'loginpost')->name('loginpost');
        Route::get('/register', 'register')->name('register');
        Route::post('/regispost', 'regispost')->name('regispost'); 
    });
    Route::get('/logout', 'logout')->name('logout')->middleware('auth');
});
Route::middleware('auth')->group(function () {


Route::middleware(['checkRole:admin,petugas'])->group(function () {
    Route::controller(KategoribukuController::class)->group(function () {
        Route::get('/kategoribuku', 'index')->name('kategoribuku.index');
        Route::get('/kategoribuku/create', 'create')->name('kategoribuku.create');
        Route::post('/kategoribuku', 'store')->name('kategoribuku.store');
        Route::get('/kategoribuku-update/{kategoribukus}', 'edit')->name('kategoribuku.edit');
        Route::patch('/kategoribuku-update/{kategoribukus}', 'update')->name('kategoribuku.update');
        Route::delete('/kategoribuku-delete/{kategoribukus}', 'destroy')->name('kategoribuku.destroy');
    });
    
    Route::controller(BukuController::class)->group(function () {
        Route::get('/buku', 'index')->name('buku.index');
        Route::get('/buku/create', 'create')->name('buku.create');
        Route::post('/buku', 'store')->name('buku.store');
        Route::get('/daftar-update-buku/{bukus}', 'edit')->name('buku.edit');
        Route::patch('/daftar-update-buku/{bukus}', 'update')->name('buku.update');
        Route::delete('/buku/{bukus}', 'destroy')->name('buku.destroy');
    });
    
    Route::get('/kategoribuku/search', function (Request $request) {
        $query = $request->get('query');
    
        $kategori = Kategoribuku::where('nama_kategori', 'LIKE', "%{$query}%")
                    ->select('id', 'nama_kategori')
                    ->get();
    
        return response()->json($kategori);
    });
    
    Route::get('/bukucari/search', function (Request $request) {
        $query = $request->get('query');
    
        $buku = Buku::where('judul', 'LIKE', "%{$query}%")
                    ->select('id', 'judul')
                    ->get();
    
        return response()->json($buku);
    });
    
    Route::get('/user/search', function (Request $request) {
        $query = $request->get('query');
    
        $user = User::where('role', 'user')
                    ->where('name', 'LIKE', "%{$query}%")
                    ->select('id', 'name')
                    ->get();
    
        return response()->json($user);
    });
    
});

Route::controller(PeminjamanController::class)->group(function () {
    Route::post('/peminjaman/{id}', 'peminjaman')->name('peminjaman');
    Route::get('/permintaan', 'permintaan')->name('permintaan');
    Route::get('/semua-peminjaman', 'allpeminjaman')->name('allpeminjaman');
    Route::post('/terima/{id}', 'terima')->name('terima');
    Route::post('/tolak/{id}', 'tolak')->name('tolak');
    Route::post('/manualpeminjaman', 'manualpeminjaman')->name('manualpeminjaman');
    Route::get('/formpinjaman', 'formpinjaman')->name('formpinjaman');
});

Route::controller(PengembalianController::class)->group(function () {
    Route::get('/pengembalian/{peminjaman_id}/create',  'create')->name('pengembalian.create');
    Route::post('/pengembalian/{peminjaman_id}/store', 'store')->name('pengembalian.store');
    Route::get('/allpengembalian', 'allpengembalian')->name('pengembalian.all');
    Route::get('/pengembalian', 'pengembalian')->name('pengembalian.index');
    Route::get('/pengembalian/{id}/approve', 'approve')->name('pengembalian.approve');
});

Route::get('/home-user',[HomeController::class, 'home'])->name('home');

Route::controller(HomeController::class)->group(function () {
   Route::get('/detail-buku/{bukus}', 'detail_buku')->name('detail_buku');
   Route::get('/list-buku', 'list_buku')->name('list_buku');
   Route::get('/list-peminjaman', 'listpeminjaman')->name('list_peminjaman'); 
   Route::post('/ulasan-detail/{buku_id}','ulasan')->name('ulasan.store');
   Route::post('/tambahkoleksi/{buku_id}', 'tambahkoleksi')->name('tambahkoleksi');
   Route::get('/koleksisaya', 'koleksisaya')->name('koleksisaya');
   Route::delete('/hapuskoleksi/{koleksipribadis}', 'hapuskoleksi')->name('hapuskoleksi');
});

Route::controller(AdminController::class)->group(function () {
    Route::get('/home-admin', 'home_admin')->name('home_admin')->middleware(['checkRole:admin,petugas']);   
});

Route::middleware(['checkRole:admin,petugas'])->group(function () {
    Route::get('/pengembalian/generate', [GenerateController::class, 'pengembalianPdf'])->name('pengembalian.generate');
    Route::get('/peminjaman/generate', [GenerateController::class, 'peminjamanPdf'])->name('peminjaman.generate');
    Route::get('/buku/generate', [GenerateController::class, 'bukuPdf'])->name('buku.generate');
});


});