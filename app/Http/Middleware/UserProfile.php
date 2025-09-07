<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class UserProfile
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check()){
            if (!isAdmin() && !Auth::user()->access_panel){
                sweetAlert2([
                    'icon' => 'success',
                    'text' => 'Foto Guardada Correctamente',
                    'timer' => 3000,
                    'showCloseButton' => true,
                ]);
                return redirect()->route('web.home');
            }
        }
        return $next($request);
    }
}
