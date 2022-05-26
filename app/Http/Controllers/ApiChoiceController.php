<?php

namespace App\Http\Controllers;

use App\Http\Resources\ChoiceResource;
use App\Models\Choice;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ApiChoiceController extends Controller
{
    public function show($choice_id) {
        $choice = Choice::findOrFail($choice_id);

        return new ChoiceResource($choice);
    }

    /**************************************************************************/

    public function store($question_id, Request $request) {
        $validator = Validator::make($request->all(), [
            'option' => 'required|string|min:2|max:500',
            'image' => 'image|mimes:jpg,jpeg,png|max:1024',
            'right_answer' => 'required|boolean'
        ]);

        if($validator->fails()) {
            return Response::json([
                'validation-errors' => $validator->errors()
            ]);
        }

        $path = null;
        if($request->hasFile('image')) {
            $path = Storage::putFile('choices', $request->file('image'));
        }

        $question = Question::findOrFail($question_id);

        $question->choices()->create([
            'option' => $request->option,
            'image' => $path,
            'right_answer' => $request->right_answer
        ]);

        return Response::json([
            'message' => 'choice created successfully'
        ]);
    }

    /**************************************************************************/

    public function update($choice_id, Request $request) {
        $validator = Validator::make($request->all(), [
            'option' => 'required|string|min:2|max:500',
            'image' => 'image|mimes:jpg,jpeg,png|max:1024',
            'right_answer' => 'required|boolean'
        ]);

        if($validator->fails()) {
            return Response::json([
                'validation-errors' => $validator->errors()
            ]);
        }

        $choice = Choice::findOrFail($choice_id);
        $path = $choice->image;

        if($request->hasFile('image')) {
            if($path != null) { Storage::delete($path); }
            $path = Storage::putFile('choices', $request->file('image'));
        }

        $choice->update([
            'option' => $request->option,
            'image' => $path,
            'right_answer' => $request->right_answer
        ]);

        return Response::json([
            'message' => 'choice updated successfully'
        ]);
    }
}
