<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;		//Class ini akan kita pakai untuk mendapatkan input dari form. Jadi sekarang kita tidak memakai class facade Request.
use App\User;						//Memanggil model User{}.
use Validator;						//Memanggil facade class Validator{}. Ini untuk Validasi.
use Session;						//Memanggil class facade Session{}

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */	 
	public function __construct()		//Perintah untuk memanggil middleware auth.
	{
		$this->middleware('auth');	//Untuk mengakses UserController harus login dulu (sementara).
		$this->middleware('admin'); //Middleware ini untuk memeriksa apakah user itu admin.
	}	 
    protected function index()		// Method Index untuk menampilkan daftar user.
    {
        //
		$user_list = User::all();
		return view('user.index', array('user_list'=>$user_list,));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected function create()	// Method Create Untuk menampilkan form tambah user
    {
        //
		return view('user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)		//Method Store untuk menyimpan data user pada proses tambah user
    {
        //
		$data = $request->all();
		
		$validasi = Validator::make($data, [
			'name'		=> 'required|max:255',
			'email'		=> 'required|email|max:100|unique:users',
			'password'	=> 'required|confirmed|min:6',
			'level'		=> 'required|in:admin,operator'
		]);
		// die('124141212');
		if ($validasi->fails()) {
			return redirect('user/create')	
					->withInput()
					->withErrors($validasi);
		}
		
		// Hash password		Melakukan hashing pada password agar tidak disimpan "telanjang" di kolom password.
		$data['password'] = bcrypt($data['password']);
		// print_r($data);
		// die('123');
		
		User::create($data);		//Simpan data user.
		Session::flash('flash_message', 'Data user berhasil disimpan.');		//Pesan flash message berhasil disimpan.
		return redirect('user');	//Kembali ke halaman user.
	}
	
	
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) //Karena kita tidak akan menampilkan detail user maka:
    {
        //
		return redirect('user');	//Arahkan langsung ke halaman User.
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    protected function edit($id)		//Menampilkan form edit user
    {
        //
		$user = User::findOrFail($id);
		return view('user.edit', array('user'=>$user,));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id, Request $request)	//Method update untuk mengupdate data user. Seperti mengubah data user.
    {
        //
		$user = User::findOrFail($id);
		$data = $request->all();
		
		$validasi = Validator::make($data, [
			'name'		=> 'required|max:255',
			'email'		=> 'required|email|max:100|unique:users,email,' . $data['id'],	//Rules unique untuk email tidak berlaku saat melakukan edit/update
			'password'	=> 'sometimes|confirmed|min:6',
			'level'		=> 'required|in:admin,operator'
		]);

		if ($validasi->fails()) {
			return redirect("user/$id/edit")
							->withErrors($validasi)
							->withInput();
		}
		
		if ($request->has('password')) {	//Perintah ini akan memeriksa apakah pada saat update kolom password diisi, jika ya maka user ingin mengubah password.
			//Hash password.				Jika diisi maka has password tersebut sebelum disimpan.
			$data['password'] = bcrypt($data['password']);
		} else {
			// Hapus password (password tidak diupdate).
			$data = array_except($data, ['password']); //Jika tidak diisi maka kita menghilangkan input tersebut dari array $data maka kolom password  di tabel siswa tidak akan diupdate.
		}
		
		$user->update($data);	//Proses update
	Session::flash('flash_mesaage', 'Data user berhasil diupdate.');	//Pesan flash message
	
		return redirect('user'); //Tampilkan kembali halaman user.
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    protected function destroy($id)	//Method destroy untuk menghapus data user.
    {
        //
		$user = User::findOrFail($id);
		$user->delete();
	Session::flash('flash_message', 'Data user berhasil dihapus.');
		Session::flash('penting', true);
		return redirect('user');
    }
}
?>