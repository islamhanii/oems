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
    public function show($id) {
        $bank = Bank::findOrFail($id);

        return new BankResource($bank);
    }

    /***************************************************************************/

    public function banks($id) {
        $banks = Course::findOrFail($id)->banks()->paginate(8);

        if(count($banks) == 0) {
            return Response::json([
                'message' => 'no banks founded'
            ]);
        }

        return BankResource::collection($banks);
    }

    /***************************************************************************/

    public function store($id, Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|min:3|max:100'
        ]);

        if($validator->fails()) {
            return Response::json([
                'validation-errors' => $validator->errors()
            ]);
        }

        Bank::create([
            'course_id' => $id,
            'name' => $request->name
        ]);

        return Response::json([
            'message' => 'bank created successfully'
        ]);
    }

    /***************************************************************************/

    public function update($id, Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|min:3|max:100'
        ]);

        if($validator->fails()) {
            return Response::json([
                'validation-errors' => $validator->errors()
            ]);
        }

        $bank = Bank::findOrFail($id);

        $bank->update([
            'name' => $request->name
        ]);

        return Response::json([
            'message' => 'bank updated successfully'
        ]);
    }
}
