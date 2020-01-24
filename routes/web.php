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


Route::get('/', function () {
    if(Auth::check()) {
        return redirect()->route('home');
    } 
    $data = \App\FrontPage::first();
    return view('auth.login',compact('data'));
});

Route::post('/login', 'Auth\LoginController@login')->name('login');
Route::get('/login', function () {
    return redirect('/');
});

Route::get('/logout', function() {
    Auth::logout();
    return redirect()->to('/');
});

//Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::group(['middleware' => ['auth', 'role:superadmin']], function () {
    //Route Master Data

    Route::get('/masterdata/sekolah', 'MasterDataController@sekolah');
    Route::get('/masterdata/sekolah/tambah', 'MasterDataController@tambahSekolah');
    Route::post('/masterdata/sekolah/{id}/update', 'MasterDataController@updateSekolah');
    Route::get('/masterdata/sekolah/{id}/delete', 'MasterDataController@deleteSekolah');
    Route::get('/masterdata/sekolah/{id}/edit', 'MasterDataController@editSekolah');
    Route::post('/masterdata/sekolah/simpan', 'MasterDataController@simpanSekolah');
    
    Route::get('/masterdata/jabatan', 'MasterDataController@jabatan');
    Route::post('/masterdata/jabatan', 'MasterDataController@simpanjabatan');
    Route::post('/masterdata/jabatan/update', 'MasterDataController@updatejabatan');
    Route::get('/masterdata/jabatan/{id}/delete', 'MasterDataController@deletejabatan');
    
    Route::get('/masterdata/wbk', 'MasterDataController@wbk');
    Route::post('/masterdata/wbk', 'MasterDataController@simpanwbk');
    Route::post('/masterdata/wbk/update', 'MasterDataController@updatewbk');
    Route::get('/masterdata/wbk/{id}/delete', 'MasterDataController@deletewbk');

    Route::get('/masterdata/wbbm', 'MasterDataController@wbbm');
    Route::post('/masterdata/wbbm', 'MasterDataController@simpanwbbm');
    Route::post('/masterdata/wbbm/update', 'MasterDataController@updatewbbm');
    Route::get('/masterdata/wbbm/{id}/delete', 'MasterDataController@deletewbbm');

    Route::get('/masterdata/komponen', 'MasterDataController@komponen');
    Route::post('/masterdata/komponen', 'MasterDataController@simpankomponen');
    Route::post('/masterdata/komponen/update', 'MasterDataController@updatekomponen');
    Route::get('/masterdata/komponen/{id}/delete', 'MasterDataController@deletekomponen');

    Route::get('/masterdata/style', 'MasterDataController@style');
    Route::post('/masterdata/style/update', 'MasterDataController@updateStyle');

    //Route User
    Route::get('/kelola_user', 'MasterDataController@user');

    //report
    Route::get('/report/sekolah', 'ReportController@sekolah');
    Route::get('/report/pegawai', 'ReportController@pegawai');
    Route::get('/report/siswa', 'ReportController@siswa');
    Route::get('/report/jmlpegawai', 'ReportController@jmlpegawai');
    Route::get('/report/jmlsiswa', 'ReportController@jmlsiswa');

    //pdf
    Route::get('/pdf/sekolah', 'ReportController@pdfsekolah');
    Route::get('/pdf/jmlpegawai', 'ReportController@pdfjmlp');
    Route::get('/pdf/jmlsiswa', 'ReportController@pdfjmls');
    Route::get('/report/pegawai/{id}/cetak', 'ReportController@pdfpegawai');
    Route::get('/report/siswa/{id}/cetak', 'ReportController@pdfsiswa');

});


Route::group(['middleware' => ['auth', 'role:sekolah']], function () {
    
    Route::get('/pegawai', 'SekolahController@pegawai');
    Route::post('/pegawai/simpan', 'SekolahController@simpanpegawai');
    Route::post('/pegawai/update/{id}', 'SekolahController@updatepegawai');
    Route::get('/pegawai/{id}/edit', 'SekolahController@editpegawai');
    Route::get('/pegawai/{id}/delete', 'SekolahController@deletepegawai');
    Route::get('/pegawai/tambah ', 'SekolahController@tambahpegawai');

    Route::get('/siswa', 'SekolahController@siswa');
    Route::post('/siswa/simpan', 'SekolahController@simpansiswa');
    Route::get('/siswa/tambah ', 'SekolahController@tambahsiswa');
    Route::get('/siswa/edit/{id} ', 'SekolahController@editsiswa');
    Route::get('/siswa/delete/{id} ', 'SekolahController@deletesiswa');
    Route::post('/siswa/update/{id} ', 'SekolahController@updatesiswa');
    Route::get('/account', 'SekolahController@account');
    Route::post('/account', 'SekolahController@saveaccount');
    
});
