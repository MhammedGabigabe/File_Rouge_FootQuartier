<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;


class IsModerateur
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();
        if (!$user || !$user->isModerateur()) {
            abort(403, 'Accès réservé aux modérateurs.');
        }

        if(!$user->estApprouve){
            return redirect()->route('attente.approbation');
        }
        return $next($request);
    }
}
