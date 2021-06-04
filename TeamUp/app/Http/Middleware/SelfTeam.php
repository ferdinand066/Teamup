<?php

namespace App\Http\Middleware;

use App\Models\Team;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SelfTeam
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $team = Team::where('id', $request->id)->first();
        if ($team && $team->creator_id == Auth::user()->id) return $next($request);
        return redirect()->route('team');
    }
}
