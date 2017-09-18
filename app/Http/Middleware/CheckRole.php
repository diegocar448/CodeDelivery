<?php

namespace CodeDelivery\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        //Se não tiver autenticado volta para a pagina login
        if (!Auth::check()) 
        {
            return redirect('/auth/login');
        }

        //somente o admin terá acesso ao painel administrativo
        if (Auth::user()->role <> "admin") 
        {
            return redirect('auth/login');
        }        

        return $next($request);
    }
}
