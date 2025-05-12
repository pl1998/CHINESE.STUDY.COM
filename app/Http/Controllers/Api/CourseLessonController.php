<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\CourseLesson;
use Illuminate\Http\Request;

class CourseLessonController extends Controller
{
    // 列表接口
    public function index(Request $request)
    {
        $perPage = $request->input('per_page', 6);
        $data = CourseLesson::orderBy('id', 'desc')->paginate($perPage);
        return response()->json($data);
    }

    // 详情接口
    public function show($id)
    {
        $lesson = CourseLesson::findOrFail($id);
        return response()->json($lesson);
    }
}
