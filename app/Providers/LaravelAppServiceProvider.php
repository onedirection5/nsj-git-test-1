<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Request;

class LaravelAppServiceProvider extends ServiceProvider
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
        //
		$halaman = '';
		if (Request::segment(1) == 'siswa') {	// Untuk halaman Menu Siswa.
			$halaman = 'siswa';
		}
		
		if (Request::segment(1) == 'about') { 	// Untuk halaman Menu About.
			$halaman = 'about';
		}
		
		if (Request::segment(1) == 'kelas') { 	// Untuk halaman Menu Kelas NavBar.
			$halaman = 'kelas';
		}
			
		if (Request::segment(1) == 'hobi') {	// Untuk halaman Menu Hobi di NavBar.
			$halaman = 'hobi';	
		}
		
		if (Request::segment(1) == 'user') {	// Untuk halaman Menu User di NavBar.
			$halaman = 'user';
		}
		
		view()->share('halaman', $halaman);
    }
}
?>