<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class IsJoueur
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();
        if(!$user || !$user->isJoueur()){
            abort(403, 'Vous n’avez pas accès à cet espace');
        }
        return $next($request);
    }
}
