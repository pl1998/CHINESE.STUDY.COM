<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CoursePracticeTopic;
use Illuminate\Support\Facades\Validator;

class CoursePracticeTopicController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'practice_id' => 'required|integer',
            'name'        => 'required|string|max:40',
            'email'       => 'required|email|max:255',
            'website'     => 'nullable|string|max:255',
            'content'     => 'required|string|max:2000',
            'is_show'     => 'required|in:0,1',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation failed.',
                'errors'  => $validator->errors(),
            ], 422);
        }

        $topic = CoursePracticeTopic::create(null_filter($request->input()));

        return response()->json([
            'message' => 'Comment submitted successfully.',
            'data'    => $topic,
            'status'  => 200,
        ]);
    }
}
