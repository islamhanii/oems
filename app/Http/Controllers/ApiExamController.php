<?php

namespace App\Http\Controllers;

use App\Http\Resources\ExamResource;
use App\Models\Course;
use App\Models\Exam;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class ApiExamController extends Controller
{
    public function show($exam_id) {
        $exam = Exam::findOrFail($exam_id);

        return new ExamResource($exam);
    }

    /***************************************************************************/

    public function exams($course_id) {
        $exams = Course::findOrFail($course_id)->exams()->get();

        if(count($exams) == 0) {
            return Response::json([
                'message' => 'no exams founded'
            ]);
        }

        return ExamResource::collection($exams);
    }

    /***************************************************************************/

    public function store($course_id, Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|min:3|max:100',
            'description' => 'required|string|min:10|max:1000',
            'duration_minutes' => 'required|integer|min:5|max:255',
            'totle' => 'required|integer|min:1|max:255',
            'active_minutes' => 'required|integer|min:1|max:255',
            'started_at' => 'required|date_format:"Y-m-d H:i:s"|after:now'
        ]);

        if($validator->fails()) {
            return Response::json([
                'validation-errors' => $validator->errors()
            ]);
        }

        $course = Course::findOrFail($course_id);

        $course->exams()->create([
            'name' => $request->name,
            'description' => $request->description,
            'duration_minutes' => $request->duration_minutes,
            'totle' => $request->totle,
            'active_minutes' => $request->active_minutes,
            'started_at' => $request->started_at
        ]);

        return Response::json([
            'message' => 'exam created successfully'
        ]);
    }

    /***************************************************************************/

    public function update($exam_id, Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|min:3|max:100',
            'description' => 'required|string|min:10|max:1000',
            'duration_minutes' => 'required|integer|min:5|max:255',
            'totle' => 'required|integer|min:1|max:255',
            'active_minutes' => 'required|integer|min:1|max:255',
            'started_at' => 'required|date_format:"Y-m-d H:i:s"|after:now'
        ]);

        if($validator->fails()) {
            return Response::json([
                'validation-errors' => $validator->errors()
            ]);
        }

        $exam = Exam::findOrFail($exam_id);

        $exam->update([
            'name' => $request->name,
            'description' => $request->description,
            'duration_minutes' => $request->duration_minutes,
            'totle' => $request->totle,
            'active_minutes' => $request->active_minutes,
            'started_at' => $request->started_at
        ]);

        return Response::json([
            'message' => 'exam updated successfully'
        ]);
    }

    /***************************************************************************/

    public function addQuestion($exam_id, $question_id) {
        $exam = Exam::findOrFail($exam_id);

        $exam->questions()->attach($question_id);

        return Response::json([
            'message' => 'question added to the exam successfully.'
        ]);
    }

    /***************************************************************************/

    public function addBank($exam_id, $bank_id, Request $request) {
        $request->questions_num = DB::table('questions')->where('bank_id', $bank_id)->count();
        
        $validator = Validator::make($request->all(), [
            'number_of_questions' => "required|integer|min:1|max:$request->questions_num"
        ]);

        if($validator->fails()) {
            return Response::json([
                'validation-errors' => $validator->errors()
            ]);
        }
        
        $exam = Exam::findOrFail($exam_id);

        $exam->banks()->attach($bank_id, [
            'number_of_questions' => $request->number_of_questions
        ]);

        return Response::json([
            'message' => 'bank added to the exam successfully.'
        ]);
    }
}