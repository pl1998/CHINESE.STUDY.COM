<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CourseReservation;

class CourseReservationController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'first_name' => 'required|string|max:50',
            'last_name' => 'required|string|max:50',
            'email' => 'required|email',
            'phone' => 'nullable|string|max:30',
            'phone_dial_code' => 'nullable|string|max:5',
            'start_time' => 'required|string',
            'end_time' => 'required|string',
            'repeat' => 'nullable|string',
            'pay_price' => 'required|numeric',
        ]);
        $data = $request->all();
        $data['order_no'] = 'ORD' . date('YmdHis') . rand(1000, 9999);
        $reservation = CourseReservation::create([
            'fisrt_name' => $data['first_name'], // 注意你的表字段是 fisrt_name
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'phone' => $data['phone'] ?? '',
            'phone_dial_code' => $data['phone_dial_code'] ?? '',
            'start_time' => strtotime($data['start_time']),
            'end_time' => strtotime($data['end_time']),
            'repeat' => $data['repeat'] ?? '',
            'pay_price' => $data['pay_price'],
            'pay_status' => 0, // 默认未支付
            'status' => 0,     // 默认未开始
            'order_no' => $data['order_no'],
            'course_id' => $data['course_id'] ?? 0,
        ]);

        
        return response()->json([
            'order_no' => $reservation->order_no,
            'id' => $reservation->id,
        ]);
    }
}