<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Vérifie que l'utilisateur connecté a le rôle requis.
     *
     * Utilisation dans les routes : middleware('role:admin')
     * Le paramètre après ":" est le rôle attendu.
     */
    public function handle(Request $request, Closure $next, string $role): Response
    {
        // Si l'utilisateur n'est pas connecté ou n'a pas le bon rôle
        if (!$request->user() || $request->user()->role !== $role) {
            abort(403, 'Accès non autorisé.');
        }

        return $next($request);
    }
}
