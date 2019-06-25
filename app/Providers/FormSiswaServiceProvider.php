<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Kelas;
use App\Hobi;

class FormSiswaServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        // Composer ini sebagai pengganti di Controller yg dihapus.
		view()->composer('siswa.form', function($view) {
		$view->with('list_kelas', Kelas::pluck('nama_kelas', 'id'));
		$view->with('list_hobi', Hobi::pluck('nama_hobi', 'id'));
		});
		
		view()->composer('siswa.form_pencarian', function($view) {		//untuk pencarian siswa/data
			$view->with('list_kelas', Kelas::pluck('nama_kelas', 'id'));
		});
    }
}
?>