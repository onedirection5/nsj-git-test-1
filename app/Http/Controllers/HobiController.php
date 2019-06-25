<?php	//FORM CONTROLLER UNTUK MODUL HOBI

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Requests\HobiRequest;
use App\Hobi;
use Session;

class HobiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
	public function __construct()		//Perintah ini untuk memangggil middleware auth.
	{
		$this->middleware('auth');		//Untuk mengakses hobi harus login maka diberikan proteksi
	}  
    public function index()
    {
        //
		$hobi_list = Hobi::all();
		return view('hobi.index', array('hobi_list'=>$hobi_list,));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
		return view('hobi.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(HobiRequest $request)
    {
        //
		Hobi::create($request->all());
	Session::flash('flash_message', 'Data hobi berhasil disimpan.');
		return redirect('hobi');
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
    public function edit(Hobi $hobi)
    {
        //
		return view('hobi.edit', array('hobi'=>$hobi,));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Hobi $hobi, HobiRequest $request)
    {
        //
		$hobi->update($request->all());
	Session::flash('flash_message', 'Data hobi berhasil diupdate.');
		return redirect('hobi');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Hobi $hobi)
    {
        //
		$hobi->delete();
	Session::flash('flash_mesaage', 'Data hobi berhasil dihapus.');
		Session::flash('penting', true);
		return redirect('hobi');
    }
}
?>