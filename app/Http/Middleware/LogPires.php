<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class LogPires
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, bool $active = false): Response
    {
        // ANTES DA REQUISIÇÃO
        Log::debug("Estou executando antes da requisição");


        // Guardando a resposta para aplicarmos a execução de código após a requisição
        $response = $next($request);

        // DEPOIS DA REQUISIÇÃO
        if($active === true) Log::debug("Estou executando DEPOIS da requisição");

        return $response;
    }
}
