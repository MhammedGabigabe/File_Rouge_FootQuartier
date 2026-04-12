<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IsModerateur
{
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();
        if (!$user || !Auth::user()->isModerateur()) {
            abort(403, 'Accès réservé aux modérateurs.');
        }

        if(!$user->estApprouve){
            return redirect()->route('attente.approbation');
        }
        return $next($request);
    }
}
