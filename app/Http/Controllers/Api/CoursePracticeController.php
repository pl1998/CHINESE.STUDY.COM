<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\CoursePractice;
use Illuminate\Http\Request;
class CoursePracticeController extends Controller
{
    public function index(Request $request)
    {
        $params = $request->all();

        $perPage = $request->input('per_page', 6);
        $data = CoursePractice::query()
        ->when(!empty($params['level']),function($query) use ($params){
            $query->where('level', $params['level']);
        })->when(!empty($params['search']),function($query) use ($params){
            $query->where('name','like','%'.$params['search'].'%')->orWhere('zh_name','like','%'.$params['search'].'%');
        })
        ->when(!empty($params['level_label']),function($query) use ($params){
            $query->where('level_label', $params['level_label']);
        })
        ->orderByDesc(column: 'id')->paginate($perPage);
        return response()->json($data);
    }
}