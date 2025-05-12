<?php

namespace App\Http\Controllers;

use App\Models\Subscribe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;
use App\Http\Traits\InertiaTrait;

class InertiaController extends Controller
{
    use InertiaTrait;

    public function index()
    {
        return $this->inertiaConfig('Home');

    }

    public function lessons()
    {
        return $this->inertiaConfig('Lessons');

    }

    public function recorded()
    {
        return $this->inertiaConfig('RecordedLesson');

    }

    public function practice()
    {
        return $this->inertiaConfig('Practice');

    }

    public function about()
    {
        return $this->inertiaConfig('About');

    }

    public function contact()
    {
        return $this->inertiaConfig('Contact');

    }

    public function hskLesson()
    {
        return $this->inertiaConfig('HskLesson');

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
}