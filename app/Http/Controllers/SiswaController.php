<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Siswa;
use Validator;	 //DIGANTI DENGAN TEKNIK VIEW COMPOSER
use App\Telepon;
use App\Kelas;
use App\Hobi;
use App\Http\Requests\SiswaRequest;
use Storage;
use Session;

class SiswaController extends Controller
{
    //
		
	public function __construct() 		//Perintah ini untuk memanggil middleware auth
	{
		$this->middleware('auth', ['except' => [ 		//Except: kecuali untuk : tidak perlu login.
			'index',
			'show',
			'cari',
		]]);
	}
	public function index()
	{
		$siswa_list	 = Siswa::orderBy('nama_siswa', 'asc')->Paginate(4); // Untuk Pagination
		$jumlah_siswa = Siswa::count();
		return view('siswa.index', array('siswa_list'=>$siswa_list, 'jumlah_siswa'=>$jumlah_siswa,));
	}
	public function create() // Menangani form tambah siswa
	{
		// $list_kelas = Kelas::pluck('nama_kelas', 'id'); 		//Semua kode ini dipindahkan ke FormSiswaServiceProvider
		// $list_hobi	= Hobi::pluck('nama_hobi', 'id');
		// return view('siswa.create', array('list_kelas'=>$list_kelas, 'list_hobi'=>$list_hobi,));
		return view('siswa.create');
	}
	public function store(SiswaRequest $request) // Menangani penyimpanan data siswa
	{
		//dd($request->all());
		$input = $request->all();
		// die('123'.$input);
		// Upload Foto
		if ($request->file('foto')) {
			// die('abc');
			$input['foto'] = $this->uploadFoto($request);
		} //else die('cba');
			// $foto = $request->file('foto');
			// $ext  = $foto->getClientOriginalExtension();
			
		// $validator = Validator::make($input, //Ini menggunakan facade class validator[
		// $this->validate($request, [ //Validate Trait
			// 'nisn'			=> 'required|string|size:4|unique:siswa,nisn',
			// 'nama_siswa'	=> 'required|string|max:30',
			// 'tanggal_lahir'	=> 'required|date',
			// 'jenis_kelamin'	=> 'required|in:L,P',
			// 'nomor_telepon' => 'sometimes|numeric|digits_between:10,15|unique:telepon,nomor_telepon',
			// 'id_kelas'		=> 'required',
		// ]);
		
		// if ($validator->fails()) { // Validasi beserta info error
			// return redirect('siswa/create')
					// ->withInput()
					// ->withErrors($validator);
		// }
			// if ($request->file('foto')->isValid()) {
				// $foto_name	= date('YmdHis'). ".$ext";
				// $upload_path= 'fotoupload';
				// $request->file('foto')->move($upload_path, $foto_name);
				// $input['foto'] = $foto_name;
			// }
		
		// Simpan data siswa
		$siswa = Siswa::create($input);

		// Simpan data telepon
		$telepon = new Telepon;
		$telepon->nomor_telepon = $request->input('nomor_telepon');
		$siswa->telepon()->save($telepon);
		
		// Simpan hobi
		$siswa->hobi()->attach($request->input('hobi_siswa'));
		
		Session::flash('flash_message', 'Data siswa berhasil disimpan.');	//UNTUK FLASH MESSAGE.
		 
		return redirect('siswa');
	}
	public function show(Siswa $siswa) 
	{
		// $siswa   = Siswa::findOrFail($id);  // dihapus diganti dengan RouteServiceProvider
		return view('siswa.show', array('siswa'=>$siswa,));
	}
	public function edit(Siswa $siswa) // Menangani Edit dan Update
	{
		// $siswa = Siswa::findOrFail($id);  // dihapus diganti dengan RouteServiceProvider
		$siswa->nomor_telepon = isset($siswa->telepon->nomor_telepon) ? $siswa->telepon->nomor_telepon : '';
		// $list_kelas = Kelas::pluck('nama_kelas', 'id');  	//Kode ini dipindahkan ke FormSiswaServiceProvider
		// $list_hobi = Hobi::pluck('nama_hobi', 'id');
		return view('siswa.edit', array('siswa'=>$siswa,)); 	//'list_kelas'=>$list_kelas, 'list_hobi'=>$list_hobi,));
	}
	public function update(Siswa $siswa, SiswaRequest $request) // Menangani Update
	{
		// $siswa = Siswa::findOrFail($id); // dihapus diganti dengan RouteServiceProvider
		$input = $request->all();
		// // // die('123454'.$input);
		// // // $validator = Validator::make($input, [
		// // // // // // $this->validate($request, [
			// // // 'nisn'			=> 'required|string|size:4|
			// // // unique:siswa,nisn,' . $request->input('id'),
			// // // 'nama_siswa'	=> 'required|string|max:30',
			// // // 'tanggal_lahir'	=> 'required|date',
			// // // 'jenis_kelamin' => 'required|in:L,P',
			// // // 'nomor_telepon' => 'sometimes|numeric|digits_between:10,15|unique:telepon,nomor_telepon,' .
			// // // $request->input('id') . ',id_siswa',
			// // // 'id_kelas'		=> 'required',
		// // // ]);
		
		// // // if ($validator->fails()) {
			// // // return redirect('siswa/' . $id . '/edit')->withInput()
			// // // ->withErrors($validator);
		// // // }
		// print_r($request);
		// Cek apakah ada foto baru di form?
		// $foto = $request->file('foto');
		// $ext  = $foto->getClientOriginalExtension();
		// die('ext = '.$ext);
		if ($request->file('foto')) {
			// die('abc');
			// Hapus foto lama
			$this->hapusFoto($siswa);
			// Upload foto baru
			$input['foto'] = $this->uploadFoto($request);
		} //else die('cba');
			// // $exist = Storage::disk('foto')->exists($siswa->foto);
			// // if (isset($siswa->foto) && $exist) {
				// // $delete = Storage::disk('foto')->delete($siswa->foto);
			// // }
			
			// Upload foto baru
			// // $foto = $request->file('foto');
			// // $ext  = $foto->getClientOriginalExtension();
			// // if ($request->file('foto')->isValid()) {
				// // $foto_name		=	date('YmdHis'). ".$ext";
				// // $upload_path	=	'fotoupload';
				// // $request->file('foto')->move($upload_path, $foto_name);
				// // $input['foto'] = $foto_name;
			
		//Update data siswa di tabel siswa
		$siswa->update($input);
		//Update telepon di tabel telepon
		$telepon = $siswa->telepon;
		$telepon->nomor_telepon = $input['nomor_telepon'];
		$siswa->telepon()->save($telepon);
		
		//sync table hobi_siswa untuk siswa ini  
		$siswa->hobi()->sync($request->input('hobi_siswa'));
		
		Session::flash('flash_message', 'Data Siswa berhasil diupdate.');
		
		return redirect('siswa');
	}
	public function destroy(Siswa $siswa) // Menangani Delete
	{
		// $siswa = Siswa::findOrFail($id); // dihapus diganti dengan RouteServiceProvider.
		$this->hapusFoto($siswa);
		$siswa->delete();
		Session::flash('flash_message', 'Data siswa berhasil dihapus.');  //Flash Message pada Delete
		Session::flash('penting', true);
		return redirect('siswa');
	}
	public function tesCollection() // Menangani tes-collection
	{
		$data = [
			['nisn' => '1001', 'nama_siswa' => 'Agus Yulianto'],
			['nisn' => '1002', 'nama_siswa' => 'Agustina Anggraeni'],
			['nisn' => '1003', 'nama_siswa' => 'Bayu Firmansyah'],
		];
		$koleksi = collect($data);
		$koleksi->toJson();
		return $koleksi;
	}
	public function dateMutator() //Mutator
	{
		$siswa	= Siswa::findOrFail(1);
		$str	= 'Tanggal Lahir: ' .
				  $siswa->tanggal_lahir->format('d-m-Y') . '<br>' .
				  'Ulang tahun ke-30 akan jatuh pada tanggal: ' .
				  '<strong>' .
				  $siswa->tanggal_lahir->addYears(30)->format('d-m-Y').				
				  '</strong>';
		return $str;
	}
	private function uploadFoto(SiswaRequest $request)	// Fungsi upload foto dan hapus foto
	{
		// die('upload');
		$foto	= $request->file('foto');
		$ext	= $foto->getClientOriginalExtension();
		 // die('>>>'.$ext	);
		if ($request->file('foto')->isValid()) {
			$foto_name		=	date('YmdHis'). ".$ext";
			$upload_path 	= 	'fotoupload';
			$request->file('foto')->move($upload_path, $foto_name);
			
			return $foto_name;
		}   //else die('cba');
		
		return false;
	} 
	private function hapusFoto(Siswa $siswa)
	{
		$exist = Storage::disk('foto')->exists($siswa->foto);
		
		if (isset($siswa->foto) && $exist) {
			$delete = Storage::disk('foto')->delete($siswa->foto);
			if ($delete) {
				
				return true;
			}
			return false;
			
		}
	}
	public function cari (Request $request) //Untuk pencarian siswa/data
	{
		$kata_kunci		= trim($request->input('kata_kunci'));	//Mengambil nilai kata kunci dari form
		// $query			= Siswa::where('nama_siswa', 'LIKE', '%' . $kata_kunci . '%');
		// $siswa_list		= $query->paginate(2);
		// $siswa_list		= $siswa_list->appends($request->except('page'));
		// $jumlah_siswa	= $siswa_list->total();
		// $pagination		= NULL;
		// return view('siswa.index', array('siswa_list'=>$siswa_list, 'kata_kunci'=>$kata_kunci, 'pagination'=>$pagination, 'jumlah_siswa'=>$jumlah_siswa));
		if (! empty($kata_kunci)) {		//Pencarian dilakukan jika kata kunci ada, jika kosong maka alihkan ke halaman siswa.
			$jenis_kelamin	= $request->input('jenis_kelamin');		//Medapatkan jenis kelamin
			$id_kelas		= $request->input('id_kelas');			//Mendapatkan kelas
			
			// Query
			$query = Siswa::where('nama_siswa', 'LIKE', '%' . $kata_kunci . '%');	//Query dasar pencarian siswa berdasarkan nama
			// (! empty($jenis_kelamin)) ? $query->'Jenis_kelamin', $jenis_kelamin) : '';	//jika dropdwon JK dipilih tambahkan where jenis_kelamin pada query
			// (!empty($id_kelas))	? $query->where('id_kelas', $id_kelas) : ''; 	//Jika dropdown kelas dipilih tambahkan where id_kelas pada query
			(! empty($jenis_kelamin)) ? $query->JenisKelamin($jenis_kelamin) : '';	//Pemanggilan dengan method scope pada model Siswa.php
			(! empty($id_kelas)) ? $query->Kelas($id_kelas) : '';		//Pemanggilan dengan method scope pada model Siswa.php
			$siswa_list = $query->paginate(2);	//Dengan method paginate () dan teknik pencarian pagination. 2 untuk pencarian siswa 2 data per halaman.
			
			// URL Linkpagination = Menambahkan semua input sebagai querystring pada link pagination dengan method appends yg berdasarkan JK atau id_kelas.
			$pagination = (! empty($jenis_kelamin)) ? $siswa_list->appends(['jenis_kelamin' => $jenis_kelamin]) : '';
			$pagination = (! empty($id_kelas)) ? $pagination = $siswa_list->appends(['id_kelas' => $id_kelas]) : '';
			$pagination = $siswa_list->appends(['kata_kunci' => $kata_kunci]);
			
			$jumlah_siswa = $siswa_list->total();	//Data jumlah total hasil pencarian dengan method total dari class pagination.
			return view('siswa.index', array('siswa_list'=>$siswa_list, 'kata_kunci'=>$kata_kunci, 'pagination'=>$pagination, 'jumlah_siswa'=>$jumlah_siswa,
			'id_kelas'=>$id_kelas, 'jenis_kelamin'=>$jenis_kelamin,));		//Tampilkan hasil pencarian siswa pada view dan berikan data kepada view.
	}
	
	return redirect('siswa');
	}
}
?>	