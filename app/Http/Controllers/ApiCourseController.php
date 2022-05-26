<?php

namespace App\Http\Controllers;

use App\Http\Resources\CourseResource;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ApiCourseController extends Controller
{
    public function search($keyword) {
        $courses = Course::where('name', 'like', "%$keyword%")
                    ->orWhere('code', 'like', "%$keyword%")
                    ->paginate(12);

        if(count($courses) == 0) {
            return Response::json([
                'message' => 'no matched courses'
            ]);
        }

        return CourseResource::collection($courses);
    }

    /***************************************************************************/

    public function myCourses() {
        $courses = Auth::user()->courses()->paginate(12);

        if(count($courses) == 0) {
            return Response::json([
                'message' => 'no courses founded'
            ]);
        }

        return CourseResource::collection($courses);
    }

    /***************************************************************************/

    public function show($course_id) {
        $course = Course::findOrFail($course_id);

        return new CourseResource($course);
    }

    /***************************************************************************/
    
    public function store(Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|min:5|max:100',
            'code' => 'required|string|min:2|max:20',
            'description' => 'required|string|min:50|max:5000',
            'image' => 'required|image|mimes:jpg,jpeg,png|max:1024'
        ]);

        if($validator->fails()) {
            return Response::json([
                'validation-errors' => $validator->errors()
            ]);
        }

        $accesscode = rand(100000, 999999);

        $path = Storage::putFile('courses', $request->file('image'));

        Course::create([
            'name' => $request->name,
            'code' => $request->code,
            'access_code' => $accesscode,
            'description' => $request->description,
            'image' => $path
        ]);

        return Response::json([
            'message' => 'course created successfully.'
        ]);
    }

    /***************************************************************************/

    public function update($course_id, Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|min:5|max:100',
            'code' => 'required|string|min:2|max:20',
            'description' => 'required|string|min:50|max:5000',
            'image' => 'image|mimes:jpg,jpeg,png|max:1024'
        ]);

        if($validator->fails()) {
            return Response::json([
                'validation-errors' => $validator->errors()
            ]);
        }

        $course = Course::findOrFail($course_id);
        $path = $course->path;

        if($request->hasFile('image')) {
            if($path != null)   { Storage::delete($path); }
            $path = Storage::putFile('courses', $request->file('image'));
        }

        $course->update([
            'name' => $request->name,
            'code' => $request->code,
            'description' => $request->description,
            'image' => $path
        ]);

        return Response::json([
            'message' => 'course updated successfully.'
        ]);
    }

    /***************************************************************************/

    public function manageStatus($course_id, Request $request) {
        $validator = Validator::make($request->all(), [
            'status' => 'required|boolean'
        ]);

        if($validator->fails()) {
            return Response::json([
                'validation-errors' => $validator->errors()
            ]);
        }

        Course::findOrFail($course_id)->update([
            'active' => $request->status
        ]);

        return Response::json([
            'message' => 'course status updated successfully.'
        ]);
    }

    /***************************************************************************/

    public function join($course_id, Request $request) {
        $validator = Validator::make($request->all(), [
            'accesscode' => 'required|integer'
        ]);

        if($validator->fails()) {
            return Response::json([
                'validation-errors' => $validator->errors()
            ]);
        }

        $course = Course::findOrFail($course_id);

        if($course->access_code != $request->accesscode) {
            return Response::json([
                "error" => 'wrong accesscode.'
            ]);
        }

        Auth::user()->courses()->attach($course->id);

        return Response::json([
            'message' => 'you joined the course successfully.'
        ]);
    }
}
