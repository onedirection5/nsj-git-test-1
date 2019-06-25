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

// Halaman About 2
// Route::get('about', function() {
	// $halaman = 'about';
	// return view('pages.about', array('halaman'=>$halaman,));
// });

Route::get('admin/testing', 'Auth\TestingController@index');

// Named Route
Route::get('halaman-rahasia', ['as' => 'secret', function() {
		return 'Anda sedang melihat <strong>Halaman Rahasia</strong>';
}]);

Route::get('showmesecret', function() {
	return redirect()->route('secret');
});
Route::get('halaman-rahasia', 'RahasiaController@halamanRahasia')
	->name('secret');

Route::get('showmesecret', 'RahasiaController@showMeSecret');

// Menu Navbar
// Route::get('siswa', function() {
	// $halaman = 'siswa';
	// $siswa = ['Rasmus Lerdorf', 'Taylor Otwell',
			// 'Brendan Eich', 'John Resign'];
	// return view('siswa.index', array('halaman'=>$halaman, 'siswa'=>$siswa,));
// });

// Menampilkan daftar siswa 2
// Route::group(['middleware' => ['web']], function () {
	Route::get('/', 'PagesController@homepage');
	Route::get('about', 'PagesController@about');
	
	Route::auth();			//Autentikasi Login/Level User
	Route::get('/home', 'HomeController@index');	//Autentikasi Login/Level User
	// // // Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
	Route::post('login', 'Auth\LoginController@login')->name('register');
	// // // // // // Route::post('login', [ 'as' => 'login', 'uses' => 'LoginController@login']);
	Route::get('logout', 'Auth\LoginController@logout');
	// Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
	// Route::get('registrasi', function() {
		// return redirect('/');
	// });
	Route::get('register', function() {
		return redirect('/');
	});
	
	Route::resource('user', 'UserController');	//Route untuk halaman user.
	
	Route::get('siswa/cari', 'SiswaController@cari'); //Routes untuk pencarian
	Route::resource('siswa', 'SiswaController'); //Menyederhanakan route dengan RESTful Resource Controller
	Route::resource('kelas', 'KelasController'); //Untuk modul kelas.
	Route::resource('hobi', 'HobiController'); //Untuk modul Hobi.
	Route::get('siswa', 'SiswaController@index');
	Route::get('siswa/create', 'SiswaController@create');
	Route::get('siswa/{siswa}', 'SiswaController@show');
	Route::post('siswa', 'SiswaController@store'); // Menerima/memproses data dari form.
	Route::get('siswa/{siswa}/edit', 'SiswaController@edit'); //Form edit/update
	Route::patch('siswa/{siswa}', 'SiswaController@update'); //Form edit/update
	Route::delete('siswa/{siswa}', 'SiswaController@destroy'); //Form delete
	Route::get('tes-collection', 'SiswaController@tesCollection'); //Eloquent: Collection
	Route::get('date-mutator', 'SiswaController@dateMutator'); //Date Mutator
	
// Sample Data Siswa
Route::get('sampledata', function() {
	DB::table('siswa')->insert([
	
		[
			'nisn'			=> '1001',
			'nama_siswa'	=> 'Agus Yulianto',
			'tanggal_lahir'	=> '1990-02-12',
			'jenis_kelamin'	=> 'L',
			'kelas'			=> '',
			'created_at'	=> '2016-03-10 19:10:15',
			'updated_at'	=> '2016-03-10 19:10:15'
		],
		[
			
			'nisn'			=> '1002',
			'nama_siswa'	=> 'Agustina Anggraeni',
			'tanggal_lahir'	=> '1990-03-01',
			'jenis_kelamin'	=> 'P',
			'kelas'			=> '',
			'created_at'	=> '2016-03-10 19:10:15',
			'updated_at'	=> '2016-03-10 19:10:15'
		],
		[
			'nisn'			=> '1003',
			'nama_siswa'	=> 'Bayu Firmansyah',
			'tanggal_lahir'	=> '1990-06-17',
			'jenis_kelamin'	=> 'L',
			'kelas'			=> '',
			'created_at'	=> '2016-03-10 19:10:15',
			'updated_at'	=> '2016-03-10 19:10:15'
		],
		[
			'nisn'			=> '1004',
			'nama_siswa'	=> 'Citra Rahmawati',
			'tanggal_lahir'	=> '1991-12-12',
			'jenis_kelamin'	=> 'P',
			'kelas'			=> '',
			'created_at'	=> '2016-03-10 19:10:15',
			'updated_at'	=> '2016-03-10 19:10:15'
		],
		[
			'nisn'			=> '1005',
			'nama_siswa'	=> 'Dirgantara Laksana',
			'tanggal_lahir'	=> '1990-10-10',
			'jenis_kelamin'	=> 'L',
			'kelas'			=> '',
			'created_at'	=> '2016-03-10 19:10:15',
			'updated_at'	=> '2016-03-10 19:10:15'
		],
		[
			'nisn'			=> '1006',
			'nama_siswa'	=> 'Eko Satrio',
			'tanggal_lahir'	=> '1990-07-14',
			'jenis_kelamin'	=> 'L',
			'kelas'			=> '',
			'created_at'	=> '2016-03-10 19:10:15',
			'updated_at'	=> '2016-03-10 19:10:15'
		],
		[
			'nisn'			=> '1007',
			'nama_siswa'	=> 'Firda Ayu Larasati',
			'tanggal_lahir'	=> '1992-02-02',
			'jenis_kelamin'	=> 'P',
			'kelas'			=> '',
			'created_at'	=> '2016-03-10 19:10:15',
			'updated_at'	=> '2016-03-10 19:10:15'
		],
		[
			'nisn'			=> '1008',
			'nama_siswa'	=> 'Galang Rambu Anarki',
			'tanggal_lahir'	=> '1991-05-11',
			'jenis_kelamin'	=> 'L',
			'kelas'			=> '',
			'created_at'	=> '2016-03-10 19:10:15',
			'updated_at'	=> '2016-03-10 19:10:15'
		],
		[
			'nisn'			=> '1009',
			'nama_siswa'	=> 'Haris Purnomo',
			'tanggal_lahir'	=> '1991-10-10',
			'jenis_kelamin'	=> 'L',
			'kelas'			=> '',
			'created_at'	=> '2016-03-10 19:10:15',
			'updated_at'	=> '2016-03-10 19:10:15'
		],
		[
			'nisn'			=> '1010',
			'nama_siswa'	=> 'Indra Birowo',
			'tanggal_lahir'	=> '1990-12-04',
			'jenis_kelamin'	=> 'L',
			'kelas'			=> '',
			'created_at'	=> '2016-03-10 19:10:15',
			'updated_at'	=> '2016-03-10 19:10:15'
		],
	]);
});
?>