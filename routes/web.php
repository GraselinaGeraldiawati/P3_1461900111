<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Models\Guru;
use App\Models\Siswa;
use App\Models\Kelas;

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
    return view('home0111');
});

Route::post('/', function (Request $request) {
    $query = Kelas::select('siswa.id', 'siswa.nama as nama_sw', 'siswa.alamat', 'guru.nama as nama_gr', 'guru.mengajar')
        ->join('siswa', 'kelas.id_siswa', '=', 'siswa.id')
        ->join('guru', 'kelas.id_guru', '=', 'guru.id')
        ->where('siswa.nama', '=', $request->nama)
        ->first();
    if ($query) {
        return view('home_cari0111', ['data' => $query]);
    } else {
        return redirect()->back();
    }
});

Route::get('/guru', function () {
    $query = Guru::select('id', 'nama', 'mengajar')->get();
    return view('guru0111', ['guru' => $query]);
});

Route::get('/guru/tambah', function () {
    return view('guru_tambah0111');
});

Route::post('/guru/tambah', function (Request $request) {
    Guru::create($request->all());
    return redirect('/guru');
});

Route::get('/guru/hapus/{id}', function (Request $request) {
    Guru::find($request->id)->delete();
    return redirect()->back();
});

Route::get('/guru/edit/{id}', function (Request $request) {
    $query = Guru::select('id', 'nama', 'mengajar')->find($request->id)->first();
    return view('guru_ubah0111', ['siswa' => $query]);
});

Route::post('/guru/edit/{id}', function (Request $request) {
    Guru::find($request->id)->update([
        'nama' => $request->nama,
        'mengajar' => $request->mengajar
    ]);
    return redirect('/guru');
});

Route::get('/siswa', function () {
    $query = Siswa::select('id', 'nama', 'alamat')->get();
    return view('siswa0111', ['siswa' => $query]);
});

Route::get('/siswa/tambah', function () {
    return view('siswa_tambah0111');
});

Route::post('/siswa/tambah', function (Request $request) {
    Siswa::create($request->all());
    return redirect('/siswa');
});

Route::get('/siswa/hapus/{id}', function (Request $request) {
    Siswa::find($request->id)->delete();
    return redirect()->back();
});

Route::get('/siswa/edit/{id}', function (Request $request) {
    $query = Siswa::select('id', 'nama', 'alamat')->find($request->id)->first();
    return view('siswa_ubah0111', ['siswa' => $query]);
});

Route::post('/siswa/edit/{id}', function (Request $request) {
    Siswa::find($request->id)->update([
        'nama' => $request->nama,
        'alamat' => $request->alamat
    ]);
    return redirect('/siswa');
});