<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckBanned
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    
    public function handle(Request $request, Closure $next)
    {
        if(auth()->check() && (auth()->user()->status_user == 0)){
            Auth::logout();

            $request->session()->invalidate();

            $request->session()->regenerateToken();

            toastr()->error('Maaf, akun yang kamu gunakan sudah tidak aktif, Silakan kontak Admin.', 'Error!');
            return redirect()->route('login');

        }

        return $next($request);
    }
}
