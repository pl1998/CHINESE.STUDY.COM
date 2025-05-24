<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\VacationSetting;
use Illuminate\Http\Request;
use Carbon\Carbon;

class CalendarController extends Controller
{
    public function getCalendarData(Request $request)
    {
        $year = $request->input('year', date('Y'));
        $month = $request->input('month', date('n'));
        
        // 获取当月开始和结束时间（UTC）
        $monthStart = Carbon::create($year, $month, 1, 0, 0, 0, 'UTC');
        $monthEnd = $monthStart->copy()->endOfMonth();
        
        // 获取当月所有有效的假期设置，并按开始时间排序
        $settings = VacationSetting::where('is_active', 1)
            ->where(function ($query) use ($monthStart, $monthEnd) {
                $query->whereBetween('start_date', [$monthStart->timestamp, $monthEnd->timestamp])
                    ->orWhereBetween('end_date', [$monthStart->timestamp, $monthEnd->timestamp])
                    ->orWhere(function ($q) use ($monthStart, $monthEnd) {
                        $q->where('start_date', '<=', $monthStart->timestamp)
                          ->where('end_date', '>=', $monthEnd->timestamp);
                    });
            })
            ->orderBy('start_date', 'asc')
            ->get();
     
      
        
        // 生成日历数据
        $firstDay = $monthStart;
        $lastDay = $monthEnd;
        $startDay = (int)$firstDay->format('N') - 1; // 以周一为第一天
        $days = [];
        
        // 填充月初空白日期
        for ($i = 0; $i < $startDay; $i++) {
            $days[] = null;
        }

        // 生成日期数据
        for ($d = 1; $d <= $lastDay->day; $d++) {
            $isDisabled = false;
            $date = Carbon::create($year, $month, $d, 0, 0, 0, 'UTC');
            $dateStr = $date->format('Y-m-d');
            $dateTimestamp = $date->timestamp;

   // 周末直接静默
   $shanghaiDate = $date->copy()->setTimezone('Asia/Shanghai');
   $isWeekend = $shanghaiDate->isWeekend();
            // 小于当前时间戳 静默
            if(strtotime($dateStr) < strtotime(date('Y-m-d'))){
                $isDisabled = true;
                $days[] = [
                    'day' => $d,
                    'date' => $dateStr,
                    'disabled' => $isDisabled,
                    'is_weekend' => $isWeekend
                ];
                continue;
            }

         
            if($isWeekend){
                $isDisabled = true;
                $days[] = [
                    'day' => $d,
                    'date' => $dateStr,
                    'disabled' => $isDisabled,
                    'is_weekend' => $isWeekend
                ];
                continue;
            }


            foreach($settings as $setting){
                $startDate = $setting->start_date->timestamp;
                $endDate = $setting->end_date->timestamp;

                if($dateTimestamp >= $startDate && $dateTimestamp <= $endDate){
                    $isDisabled = true;
                    break;
                }
            }
            $days[] = [
                'day' => $d,
                'date' => $dateStr,
                'disabled' => $isDisabled,
                'is_weekend' => $isWeekend
            ];
        }

        return response()->json([
            'days' => $days
        ]);
    }

    public function getTimeSlots(Request $request)
    {
        $date = $request->input('date', date('Y-m-d'));
        $dateCarbon = Carbon::createFromFormat('Y-m-d', $date, 'UTC');
        
        // 获取当天的假期设置
        $settings = VacationSetting::where('is_active', 1)
            ->where(function ($query) use ($dateCarbon) {
                $startOfDay = $dateCarbon->copy()->startOfDay()->timestamp;
                $query->where('start_date', '>=', $startOfDay)->orWhere('end_date', '>=', $startOfDay);
            })
            ->orderBy('start_date', 'asc')
            ->get();

        // 生成时间段
        $timeSlots = [];
        $startHour = 12; // 从12点开始
        $endHour = 21;   // 到21点结束
        
        for ($hour = $startHour; $hour <= $endHour; $hour++) {
            $slotTime = sprintf('%02d:00 - %02d:45', $hour, $hour);
         
            $isDisabled = false;

               // 获取当前日期的时间段
               $currentSlotStart = Carbon::createFromFormat('Y-m-d H:i', $date . ' ' . sprintf('%02d:00', $hour))->timestamp;
               $currentSlotEnd = Carbon::createFromFormat('Y-m-d H:i', $date . ' ' . sprintf('%02d:45', $hour))->timestamp;
             
            
            // 检查当前时间段是否在假期内
            foreach ($settings as $setting) {
                $startDate =$setting->start_date->timestamp;
                $endDate = $setting->end_date->timestamp;
            
                if($currentSlotStart >= $startDate || $currentSlotStart <= $endDate){
                    $isDisabled = true;
                    break;
                }
                if($currentSlotEnd <= $endDate){
                    $isDisabled = true;
                    break;
                }
               
            }
            
            $timeSlots[] = [
                'time' => $slotTime,
                'disabled' => $isDisabled
            ];
        }

        return response()->json([
            'time_slots' => $timeSlots
        ]);
    }
} 