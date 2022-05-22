<?php

namespace App\Http\Controllers;

use App\Http\Resources\QuestionResource;
use App\Models\Bank;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;


class ApiQuestionController extends Controller {
    
    public function show($id) {
        $question = Question::findOrFail($id);

        return new QuestionResource($question);
    }

    /***************************************************************************/

    public function questions($id) {
        $questions = Bank::findOrFail($id)->questions()->get();

        if(count($questions) == 0) {
            return Response::json([
                'message' => 'no banks founded'
            ]);
        }

        return QuestionResource::collection($questions);
    }

    /***************************************************************************/

    public function store($id, Request $request) {
        $validator = Validator::make($request->all(), [
            'header' => 'required|string|min:10|max:5000',
            'diffculty' => 'required|in:easy,normal,hard',
            'image.*' => 'image|mimes:jpg,jpeg,png|max:2048'
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

        $question = Question::create([
            'bank_id' => $id,
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

    public function update($id, Request $request) {
        $validator = Validator::make($request->all(), [
            'header' => 'required|string|min:10|max:5000',
            'diffculty' => 'required|in:easy,normal,hard',
            'image.*' => 'image|mimes:jpg,jpeg,png|max:2048'
        ]);

        if($validator->fails()) {
            return Response::json([
                'validation-errors' => $validator->errors()
            ]);
        }

        $question = Question::findOrFail($id);
        
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
}
