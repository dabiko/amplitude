<?php

namespace App\Http\Middleware;

use App\Models\logs;
use App\Models\User;
use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Symfony\Component\HttpFoundation\Response;

class UserActivity
{
    /**
     * Handle an incoming request.
     *
     * @param Closure(Request): (Response) $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check()) {
            $expires_after = Carbon::now()->addSeconds(10);
            Cache::put('user-online' . Auth::id(), true, $expires_after);

            User::findOrFail(Auth::id())->update([
               'last_activity' => $expires_after,
               'status' => 1,
            ]);

        }

        return $next($request);
    }
}
