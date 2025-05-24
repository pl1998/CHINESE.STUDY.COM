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
            $date = Carbon::create($year, $month, $d, 0, 0, 0, 'UTC');
            $dateStr = $date->format('Y-m-d');
            
            // 转换为上海时区检查是否是周末
            $shanghaiDate = $date->copy()->setTimezone('Asia/Shanghai');
            $isWeekend = $shanghaiDate->isWeekend();
            
            // 检查是否是假期
            $isVacation = $settings->contains(function ($setting) use ($date) {
                $startDate = Carbon::createFromTimestamp($setting->start_date, 'UTC');
                $endDate = Carbon::createFromTimestamp($setting->end_date, 'UTC');
                return $date->between($startDate->startOfDay(), $endDate->endOfDay());
            });
            
            // 如果是周末或假期，设置为禁用
            $isDisabled = $isWeekend || $isVacation || $date->lt(Carbon::now('UTC'));
            
            $days[] = [
                'day' => $d,
                'date' => $dateStr,
                'disabled' => $isDisabled,
                'is_vacation' => $isVacation,
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
                $endOfDay = $dateCarbon->copy()->endOfDay()->timestamp;
                
                $query->whereBetween('start_date', [$startOfDay, $endOfDay])
                    ->orWhereBetween('end_date', [$startOfDay, $endOfDay])
                    ->orWhere(function ($q) use ($startOfDay, $endOfDay) {
                        $q->where('start_date', '<=', $startOfDay)
                          ->where('end_date', '>=', $endOfDay);
                    });
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
            
            // 检查当前时间段是否在假期内
            foreach ($settings as $setting) {
                $startDate = Carbon::createFromTimestamp($setting->start_date, 'UTC');
                $endDate = Carbon::createFromTimestamp($setting->end_date, 'UTC');
                
                // 获取当前日期的时间段
                $currentSlotStart = Carbon::createFromFormat('Y-m-d H:i', $date . ' ' . sprintf('%02d:00', $hour), 'UTC');
                $currentSlotEnd = Carbon::createFromFormat('Y-m-d H:i', $date . ' ' . sprintf('%02d:45', $hour), 'UTC');
                
                // 如果当前时间段与假期时间有重叠，则禁用
                if (
                    ($currentSlotStart->between($startDate, $endDate)) ||
                    ($currentSlotEnd->between($startDate, $endDate)) ||
                    ($startDate->between($currentSlotStart, $currentSlotEnd)) ||
                    ($endDate->between($currentSlotStart, $currentSlotEnd))
                ) {
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