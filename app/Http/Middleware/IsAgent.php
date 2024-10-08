<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class IsAgent
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!(Auth::check() && Auth::user()->role && strtolower(Auth::user()->role->name) === 'agent') ){
            return redirect('/dashboard');
        }


        return $next($request);
        //return redirect('/')->with('error','votre compte n\'est pas agent');
    }
}
