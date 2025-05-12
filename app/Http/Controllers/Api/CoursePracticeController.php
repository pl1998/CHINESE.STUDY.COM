<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\CoursePractice;
use Illuminate\Http\Request;
class CoursePracticeController extends Controller
{
    public function index(Request $request)
    {
        $perPage = $request->input('per_page', 6);
        $data = CoursePractice::orderBy('id', 'desc')->paginate($perPage);
        return response()->json($data);
    }
}