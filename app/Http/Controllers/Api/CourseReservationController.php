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
            'pay_price' => 'required|numeric',
            'every_date' => 'required|numeric',
            'end_date' => 'date',
            'recursion_number' => 'numeric'
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
            'pay_price' => $data['pay_price'],
            'pay_status' => 0, // 默认未支付
            'status' => 0,     // 默认未开始
            'order_no' => $data['order_no'],
            'course_id' => $data['course_id'] ?? 0,
            'every_date' => $data['every_date'],
            'end_date' => !empty($data['end_date']) ? strtotime($data['end_date']) : null,
            'recursion_number' => $data['recursion_number']
        ]);
        return response()->json([
            'order_no' => $reservation->order_no,
            'id' => $reservation->id,
        ]);
    }

    /**
     * 购买课程包
     * @param \Illuminate\Http\Request $request
     * @return mixed|\Illuminate\Http\JsonResponse
     */
    public function purchaseoursepackages(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:50',
            'email' => 'required|email',
            'phone' => 'nullable|string|max:30',
            'package_type' => 'required|in:1,2',
            'course_id' => 'required|integer'
        ]);
        $data = $request->all();
        $data['order_no'] = 'ORD' . date('YmdHis') . rand(1000, 9999);
        $reservation = CourseReservation::create([
            'fisrt_name' => $data['name'], // 注意你的表字段是 fisrt_name
            'email' => $data['email'],
            'phone' => $data['phone'] ?? '',
            'pay_price' => $data['package_type'] == 1 ? 45 : 45*6,
            'pay_status' => 0, // 默认未支付
            'status' => 0,     // 默认未开始
            'order_no' => $data['order_no'],
            'course_id' => $data['course_id'] ?? 0,
            'course_type' =>$data['package_type']
        ]);
        return response()->json([
            'order_no' => $reservation->order_no,
            'id' => $reservation->id,
        ]);
    }
}