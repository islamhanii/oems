<?php

namespace App\Http\Controllers;

use App\Http\Resources\BankResource;
use App\Models\Bank;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

class ApiBankController extends Controller
{
    public function show($bank_id) {
        $bank = Bank::findOrFail($bank_id);

        return new BankResource($bank);
    }

    /***************************************************************************/

    public function banks($course_id) {
        $banks = Course::findOrFail($course_id)->banks()->get();

        if(count($banks) == 0) {
            return Response::json([
                'message' => 'no banks founded'
            ]);
        }

        return BankResource::collection($banks);
    }

    /***************************************************************************/

    public function store($course_id, Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|min:3|max:100'
        ]);

        if($validator->fails()) {
            return Response::json([
                'validation-errors' => $validator->errors()
            ]);
        }

        $course = Course::findOrFail($course_id);

        $course->banks()->create([
            'name' => $request->name
        ]);

        return Response::json([
            'message' => 'bank created successfully'
        ]);
    }

    /***************************************************************************/

    public function update($bank_id, Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|min:3|max:100'
        ]);

        if($validator->fails()) {
            return Response::json([
                'validation-errors' => $validator->errors()
            ]);
        }

        $bank = Bank::findOrFail($bank_id);

        $bank->update([
            'name' => $request->name
        ]);

        return Response::json([
            'message' => 'bank updated successfully'
        ]);
    }
}
