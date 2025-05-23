<?php

namespace App\Http\Controllers;

use App\Models\Subscribe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;
use App\Http\Traits\InertiaTrait;
use App\Models\CourseLesson;
use App\Models\CoursePractice;
use App\Models\RecordedLesson;

class InertiaController extends Controller
{
    use InertiaTrait;

    public function index()
    {
        return $this->inertiaConfig('Home');

    }

    public function lessons()
    {
        $courses = CourseLesson::orderBy('id', 'desc')->paginate(6);
        return $this->inertiaConfig('Lessons', ['courses' => $courses]);

    }

    public function recorded()
    {
        $lessons = RecordedLesson::orderBy('id', 'desc')->paginate(9);
        return $this->inertiaConfig('RecordedLesson', ['lessons' => $lessons]);

    }

    public function practice($level_label)
    {
        return $this->inertiaConfig('Practice', ['level_label' => $level_label]);

    }

    public function about()
    {
        return $this->inertiaConfig('About');

    }

    public function contact()
    {
        return $this->inertiaConfig('Contact');

    }

    public function hskLesson($id)
    {
        $lesson = CourseLesson::find($id);
        return $this->inertiaConfig('HskLesson', ['lesson' => $lesson]);

    }

    public function survivalChinese()
    {
        return $this->inertiaConfig('SurvivalChinese');

    }

    public function debateTopics()
    {
        return $this->inertiaConfig('DebateTopics');

    }

    public function conversationalChinese()
    {
        return $this->inertiaConfig('ConversationalChinese');

    }

    public function courses($type)
    {
        return $this->inertiaConfig('Course', ['type' => $type]);

    }

    public function practiceDetail($id)
    {
        $practice = CoursePractice::with('topics.topic')->find($id);
        return $this->inertiaConfig('PracticeDetail', ['practice' => empty($practice) ? [] : $practice->toArray()]);
    }
}