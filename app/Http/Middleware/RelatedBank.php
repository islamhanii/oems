<?php

namespace App\Http\Middleware;

use App\Models\Bank;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;

class RelatedBank
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
        $user = Bank::findOrFail($request->bank_id)->course()->first()->users()->find(Auth::id());
        if($user) {
            return $next($request);
        }

        return Response::json([
            'error' => 'not authorized'
        ]);
    }
}
