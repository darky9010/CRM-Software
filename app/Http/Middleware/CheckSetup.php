<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Settings;

class CheckSetup
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $locale = $request->route('locale') ?? app()->getLocale();

// Se CompanySetting esiste, lascia passare
        if (Settings::count() > 0) {
            return $next($request);
        }

// Se siamo sulla rotta di setup (GET o POST), lascia passare
        if ($request->routeIs('settings.index') || $request->routeIs('settings.store') || $request->is("{$locale}/settings")) {
            return $next($request);
        }

// Altrimenti reindirizza
        return redirect()->route('settings.index', ['locale' => $locale]);

    }
}
