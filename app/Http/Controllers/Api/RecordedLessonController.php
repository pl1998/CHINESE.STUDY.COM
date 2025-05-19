<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\RecordedLesson;
use Illuminate\Http\Request;

class RecordedLessonController extends Controller
{
    public function index(Request $request)
    {
        $perPage = $request->input('per_page', 9);
        $data = RecordedLesson::orderBy('id', 'desc')->paginate($perPage);
        return response()->json($data);
    }
} 