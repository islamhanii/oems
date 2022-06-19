<?php

namespace App\Http\Middleware;

use App\Models\Bank;
use App\Models\Exam;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class CourseBank
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
        $bank = Bank::findOrFail($request->bank_id)->course()->first();
        $exam = Exam::findOrFail($request->exam_id)->course()->first();
        if($bank->id == $exam->id) {
            return $next($request);
        }

        return Response::json([
            'error' => 'you cannot add bank from other course'
        ]);
    }
}
