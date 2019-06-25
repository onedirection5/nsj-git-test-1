<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Requests\KelasRequest;
use App\Kelas;
use Session;

class KelasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
	public function __construct()		//Perintah untuk memanggil middleware auth.
	{
		$this->middleware('auth');		//Semua operasi di KelasController dilakukan jika user login (operator/admin) maka tidak perlu pengecualian.
	}
	public function index()
    {
        //
		$kelas_list = Kelas::all();
		return view('kelas/index', array('kelas_list'=>$kelas_list,));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
		return view('kelas.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(KelasRequest $request)
    {
        //
		Kelas::create($request->all());
	Session::flash('flash_message', 'Data kelas berhasil disimpan.');
		return redirect('kelas');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
		return view('kelas.edit', array('kelas'=>$kelas,));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
	public function update(Kelas $kelas, KelasRequest $request)
	{
		$kelas->update($request->all());
	Session::flash('flash_message', 'Data kelas berhasil diupdate.');
		return redirect('kelas');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
		$kelas->delete();
	Session::flash('flash_message', 'Data kelas berhasil dihapus.');
		Session::flash('penting', true);
		return redirect('kelas');
    }
}
?>	