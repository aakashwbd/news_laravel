<?php

namespace App\Http\Middleware;

use Closure;
use DB;
use Exception;
use Illuminate\Http\Request;

class installer
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (file_exists(storage_path('installed'))) {
            try {
                DB::connection()->getPdo();
                if (!DB::connection()->getDatabaseName()) {
                    unlink(storage_path('installed'));
                    return redirect('/install');
                }
            } catch (Exception $e) {
                unlink(storage_path('installed'));
                return redirect('/install');
            }
        } else {
            return redirect('/install');
        }
        return $next($request);
    }
}
