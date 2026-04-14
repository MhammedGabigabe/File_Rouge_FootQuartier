<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class RedirigerSiAuthentifie
{
    public function handle(Request $request, Closure $next): Response
    {
        if(Auth::check())
        {
            $user = Auth::user();
            if($user->isAdmin()){
                return redirect()->route('admin.dashboard');
            }elseif($user->isModerateur()){
                return redirect()->route('moderator.dashboard');
            }else{
                return redirect()->route('joueur.dashboard');
            }
        }
        return $next($request);
    }
}
