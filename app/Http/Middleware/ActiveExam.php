<?php

namespace App\Http\Middleware;

use App\Models\Exam;
use Closure;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;

class ActiveExam
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
        $exam = Exam::findOrFail($request->exam_id);
        $time1 = new DateTime($exam->started_at);
        $time2 = new DateTime($exam->started_at);
        $time2->modify("+{$exam->active_minutes} minutes");
        $now = new DateTime(date('Y-m-d H:i:s'));

        if(($time1 < $now && $time2 > $now) || Auth::user()->role_id == 2) {
            return $next($request);
        }
        
        return Response::json([
            'message' => 'the exam closed right now'
        ]);
    }
}
