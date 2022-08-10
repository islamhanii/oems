<?php

namespace App\Http\Controllers;

use App\Http\Resources\QuestionResource;
use App\Models\Bank;
use App\Models\Choice;
use App\Models\Exam;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ApiQuestionController extends Controller
{
    public function show($question_id) {
        $question = Question::findOrFail($question_id);

        return new QuestionResource($question);
    }

    /***************************************************************************/

    public function questions($bank_id) {
        $questions = Bank::findOrFail($bank_id)->questions()->get();

        if(count($questions) == 0) {
            return Response::json([
                'message' => 'no banks founded'
            ]);
        }

        return QuestionResource::collection($questions);
    }

    /***************************************************************************/

    public function store($bank_id, Request $request) {
        $validator = Validator::make($request->all(), [
            'header' => 'required|string|min:10|max:5000',
            'diffculty' => 'required|in:easy,normal,hard',
            'image.*' => 'image|mimes:jpg,jpeg,png|max:1024'
        ]);

        if($validator->fails()) {
            return Response::json([
                'validation-errors' => $validator->errors()
            ]);
        }

        if($request->hasFile('image')) {
            $count = count($request->image);
            if($count > 5) {
                return Response::json([
                    'validation-errors' => ['number of images' => ['a question cannot has more than 5 images']]
                ]);
            }
        }

        $bank = Bank::findOrFail($bank_id);

        $question = $bank->questions()->create([
            'header' => $request->header,
            'diffculty' => $request->diffculty,
        ]);
        
        if($request->hasFile('image')) {
            foreach($request->file('image') as $file) {
                $path = Storage::putFile('questions', $file);
                $question->images()->create([
                    'name' => $path
                ]);
            }
        }

        return Response::json([
            'message' => 'question created successfully'
        ]);
    }

    /***************************************************************************/

    public function update($question_id, Request $request) {
        $validator = Validator::make($request->all(), [
            'header' => 'required|string|min:10|max:5000',
            'diffculty' => 'required|in:easy,normal,hard',
            'image.*' => 'image|mimes:jpg,jpeg,png|max:1024'
        ]);

        if($validator->fails()) {
            return Response::json([
                'validation-errors' => $validator->errors()
            ]);
        }

        $question = Question::findOrFail($question_id);
        
        if($request->hasFile('image')) {
            $count = $question->images()->count() + count($request->image);
            if($count > 5) {
                return Response::json([
                    'validation-errors' => ['number of images' => ['a question cannot has more than 5 images']]
                ]);
            }
        }

        $question->update([
            'name' => $request->name,
            'diffculty' => $request->diffculty
        ]);
        
        if($request->hasFile('image')) {
            foreach($request->file('image') as $file) {
                $path = Storage::putFile('questions', $file);
                $question->images()->create([
                    'name' => $path
                ]);
            }
        }

        return Response::json([
            'message' => 'question updated successfully'
        ]);
    }

    /***************************************************************************/

    public function answer($exam_id, $question_id, Request $request) {
        $validator = Validator::make($request->all(), [
            'answer' => 'required|string',
        ]);

        if($validator->fails()) {
            return Response::json([
                'validation-errors' => $validator->errors()
            ]);
        }

        $answer = explode('|', $request->answer);
        $correct = 1;
        foreach($answer as $ans) {
            $id = (strlen($ans)>20 || !is_numeric($ans))?0:intval($ans);
            $choice = Choice::where('id', $id)->where('question_id', $question_id)->first();
            
            if($choice == null) {
                return Response::json([
                    'validation-errors' => [
                        'answer' => 'submitted choices are not correct'
                    ]
                ]);
            }
            if($choice->right_answer == 0) {
                $correct = 0;
            }
        }

        if($correct == 1) {
            $choices = Question::findOrFail($question_id)->choices()->where('right_answer', 1)->count();
            if(count($answer) != $choices) {
                $correct = 0;
            }
        }

        Auth::user()->questions()->updateExistingPivot($question_id, [
            'exam_id' => $exam_id,
            'answer' => $request->answer,
            'correct' => $correct
        ]);

        $exam = Auth::user()->questions()->where('exam_id', $request->exam_id);
        $total = $exam->count();
        $score = $exam->where('correct', 1)->count();
        $total = ($score/$total) * Exam::findOrFail($exam_id)->totle;

        $time_minutes = intval((strtotime(date("Y-m-d H:i:s")) - strtotime($exam->first()->created_at))/60);
        
        Auth::user()->exams()->updateExistingPivot($exam_id, [
            'score' => number_format($total, 2, '.'),
            'time_minutes' => $time_minutes
        ]);

        return Response::json([
            'message' => 'your answer submitted successfully.'
        ]);
    }
}
