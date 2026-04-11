<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use App\Models\Resposta;

class CheckQuestionario
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
            $user = Auth::user();

            // Se for admin, não precisa responder
            if ($user->role === 'admin') {
                return $next($request);
            }

            // Se for user e não respondeu, redireciona para o questionário
            $jaRespondeu = Resposta::where('user_id', $user->id)->exists(); 
            if (!$jaRespondeu) { return redirect()->route('questionario'); } 
            return $next($request); 
            
} } 
    
