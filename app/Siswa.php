<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    //
	protected $table = 'siswa';
	
	protected $fillable = [
		'nisn',
		'nama_siswa',
		'tanggal_lahir',
		'jenis_kelamin',
		'id_kelas',
		'foto',
	];
	
	protected $dates = ['tanggal_lahir'];
	
	// protected $primaryKey = 'siswa_id';
	
	public function getNamaSiswaAttribute($nama_siswa)
	{
		//Accessor
		return ucwords($nama_siswa);
	}
	public function setNamaSiswaAttribute($nama_siswa)
	{
		//Mutator
		return $this->attributes['nama_siswa'] = strtolower($nama_siswa);
	}
	public function telepon()
	{	
		//method telepon dari sisi siswa [one to one].
		return $this->hasOne('App\Telepon', 'id_siswa');
	}
	public function kelas()
	{
		return $this->belongsTo('App\Kelas', 'id_kelas');
	}
	public function hobi()
	{
		return $this->belongsToMany('App\Hobi', 'hobi_siswa',
		'id_siswa', 'id_hobi')->withTimeStamps();
	}
	public function getHobiSiswaAtttribute()
	{
		return $this->hobi->pluck('id')->toArray();
	}
	public function getHobiSiswaAttribute()
	{
		return $this->hobi->pluck('id')->toArray();
	}
	public function scopeKelas($query, $id_kelas)	//method scope untuk memberi batasan filter (diawali dengan kata Scope) lalu nama scope nya (contoh:scopeKelas).
	{
		return $query->where('id_kelas', $id_kelas);	//jika method scope menerima argument maka tempatkan setelah argument $query
	}
	public function scopeJenisKelamin($query, $jenis_kelamin)
	{
		return $query->where('jenis_kelamin', $jenis_kelamin);
	}
}
?>