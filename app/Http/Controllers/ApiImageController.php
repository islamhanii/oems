<?php

namespace App\Http\Controllers;

use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ApiImageController extends Controller
{
    public function delete($image_id) {
        $image = Image::findOrFail($image_id);
        Storage::delete($image->name);
        $image->delete();

        $message = ["message" => "image deleted successfully"];
        return response()->json($message);
    }
}
