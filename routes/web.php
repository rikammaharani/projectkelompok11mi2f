<?php

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

Auth::routes();

Route::get('/', 'DashboardController@index')->name('dashboard');

// Kelas
Route::get('kelas', 'KelasController@index')->name('kelas');
Route::get('kelas/create', 'KelasController@create')->name('createKelas');
Route::post('kelas/store', 'KelasController@store')->name('storeKelas');
Route::get('kelas/edit/{id}', 'KelasController@edit')->name('editKelas');
Route::post('kelas/update/{id}', 'KelasController@update')->name('updateKelas');
Route::get('kelas/delete/{id}', 'KelasController@destroy')->name('deleteKelas');

// Mata Kuliah
Route::get('matkul', 'MataKuliahController@index')->name('matkul');
Route::get('matkul/create', 'MataKuliahController@create')->name('createMatkul');
Route::post('matkul/store', 'MataKuliahController@store')->name('storeMatkul');
Route::get('matkul/edit/{id}', 'MataKuliahController@edit')->name('editMatkul');
Route::post('matkul/update/{id}', 'MataKuliahController@update')->name('updateMatkul');
Route::get('matkul/delete/{id}', 'MataKuliahController@destroy')->name('deleteMatkul');

// Dosen
Route::get('dosen', 'DosenController@index')->name('dosen');
Route::get('dosen/create', 'DosenController@create')->name('createDosen');
Route::post('dosen/store', 'DosenController@store')->name('storeDosen');
Route::get('dosen/edit/{id}', 'DosenController@edit')->name('editDosen');
Route::post('dosen/update/{id}', 'DosenController@update')->name('updateDosen');
Route::get('dosen/delete/{id}', 'DosenController@destroy')->name('deleteDosen');
Route::get('dosen/biodata/{nip}', 'DosenController@show')->name('biodataDosen');
Route::get('dosen/biodata/edit/{id}', 'DosenController@editBiodata')->name('editBiodataDosen');
Route::post('dosen/biodata/update/{id}', 'DosenController@updateBiodata')->name('updateBiodataDosen');

// Mahasiswa
Route::get('mahasiswa', 'MahasiswaController@index')->name('mahasiswa');
Route::get('mahasiswa/create', 'MahasiswaController@create')->name('createMahasiswa');
Route::post('mahasiswa/store', 'MahasiswaController@store')->name('storeMahasiswa');
Route::get('mahasiswa/edit/{id}', 'MahasiswaController@edit')->name('editMahasiswa');
Route::post('mahasiswa/update/{id}', 'MahasiswaController@update')->name('updateMahasiswa');
Route::get('mahasiswa/delete/{id}', 'MahasiswaController@destroy')->name('deleteMahasiswa');
Route::get('mahasiswa/biodata/{nim}', 'MahasiswaController@show')->name('biodataMahasiswa');
Route::get('mahasiswa/biodata/edit/{id}', 'MahasiswaController@editBiodata')->name('editBiodataMahasiswa');
Route::post('mahasiswa/biodata/update/{id}', 'MahasiswaController@updateBiodata')->name('updateBiodataMahasiswa');

// User
Route::get('user', 'UserController@index')->name('user');
Route::get('user/delete/{id}', 'UserController@destroy')->name('deleteUser');

// Penilaian
Route::get('penilaian/penilaian', 'PenilaianController@indexDosen')->name('penilaian');
Route::get('penilaian/create/{id}', 'PenilaianController@create')->name('createPenilaian');
Route::post('penilaian/store', 'PenilaianController@store')->name('storePenilaian');
Route::get('penilaian/edit/{id}', 'PenilaianController@edit')->name('editPenilaian');
Route::post('penilaian/update/{id}', 'PenilaianController@update')->name('updatePenilaian');
Route::get('penilaian/delete/{id}', 'PenilaianController@destroy')->name('deletePenilaian');
Route::get('penilaian/nilai', 'PenilaianController@indexMahasiswa')->name('nilaiMahasiswa');
Route::get('penilaian/khs', 'PenilaianController@khs')->name('cetakKHS');
