<?php

namespace App\Http\Middleware;

use App\Models\Exam;
use App\Models\Question;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class CourseQuestion
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
        $question = Question::findOrFail($request->question_id)->bank()->first()->course()->first();
        $exam = Exam::findOrFail($request->exam_id)->course()->first();
        if($question->id == $exam->id) {
            return $next($request);
        }

        return Response::json([
            'error' => 'you cannot add question from other exam'
        ]);
    }
}
