<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Course;
use Illuminate\Support\Facades\Response;

class ActiveCourse
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
        $course = Course::find($request->id);
        if(!$course || $course->active) {
            return $next($request);
        }
        
        return Response::json([
            'message' => 'the course is under maintenance'
        ]);
    }
}
