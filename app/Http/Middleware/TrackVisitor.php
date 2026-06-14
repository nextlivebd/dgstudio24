<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TrackVisitor
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Only track visitors on non-admin and non-api routes
        if (!$request->is('admin/*') && !$request->is('api/*') && !$request->is('server-setup-run') && !$request->ajax()) {
            try {
                $ip = $request->ip();
                $date = now()->format('Y-m-d');

                \App\Models\Visitor::firstOrCreate([
                    'ip_address' => $ip,
                    'visited_date' => $date
                ]);
            } catch (\Exception $e) {
                // Ignore DB errors during setup
            }
        }

        return $next($request);
    }
}
