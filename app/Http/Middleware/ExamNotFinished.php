<?php

namespace App\Http\Middleware;

use App\Models\Exam;
use Closure;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;

class ExamNotFinished
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
        $start = Auth::user()->exams()->where("exam_id", $request->exam_id)->first();
        if($start->pivot->finished == 1) {
            return Response::json([
                'message' => 'you finished this exam yet'
            ]);
        }
        
        $exam = Exam::findOrFail($request->exam_id);

        $time1 = new DateTime($start->pivot->created_at);
        $time2 = new DateTime($start->pivot->created_at);
        $time2->modify("+{$exam->duration_minutes} minutes");
        $now = new DateTime(date('Y-m-d H:i:s'));

        if(($time1 < $now && $time2 > $now) || Auth::user()->role_id == 2) {
            return $next($request);
        }
        
        return Response::json([
            'message' => 'the exam time was finished'
        ]);
    }
}
