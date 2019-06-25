<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;			//menggunakan facade class auth (dipanggil terlebih dahulu).

class RedirectIfNotAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)		//Ini untuk membuat Middleware Admin (php artisan make:middleware RedirectIfNotAdmin)
    {
		if (!(Auth::user()->level == 'admin')) {		//(perhatikan tanda seru !) Jika level user yg login bukan Admin, maka alihkan  ke halaman homepage.
			return redirect('/');						//jika levelnya admin maka ditampilkan di daftar user.
		}
		
        return $next($request);
    }
}
?>