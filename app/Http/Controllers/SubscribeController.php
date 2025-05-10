<?php

namespace App\Http\Controllers;

use App\Models\Subscribe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SubscribeController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|unique:subscribes,email'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()->first(),
                'status' => 422
            ], 200);
        }

        Subscribe::create([
            'email' => $request->email
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Subscription successful!',
            'status' => 200
        ]);
    }
}