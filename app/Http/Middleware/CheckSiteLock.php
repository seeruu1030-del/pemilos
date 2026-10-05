<?php

namespace App\Http\Middleware;

use App\Models\Setting;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

class CheckSiteLock
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Bypass lock for phpunit / feature test suite execution
        if (app()->environment('testing')) {
            return $next($request);
        }

        // Allow access to the maintenance view route itself and static assets/resources
        if ($request->is('maintenance') || $request->is('build/*') || $request->is('images/*') || $request->is('favicon.ico')) {
            return $next($request);
        }

        // Check env override first if set (SITE_LOCKED=true/false in .env)
        $envLock = env('SITE_LOCKED', null);

        if ($envLock !== null) {
            $isLocked = filter_var($envLock, FILTER_VALIDATE_BOOLEAN);
        } else {
            try {
                // Check database setting, default to true (locked) as requested
                $dbVal = Setting::get('site_locked', true);
                $isLocked = filter_var($dbVal, FILTER_VALIDATE_BOOLEAN);
            } catch (Throwable $e) {
                $isLocked = true;
            }
        }

        // Redirect all incoming requests (homepage, /login, admin routes, search bar entries) to maintenance view
        if ($isLocked) {
            return redirect()->route('site.maintenance');
        }

        return $next($request);
    }
}
