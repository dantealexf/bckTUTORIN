<?php

namespace App\Http\Controllers;

use App\Models\Advisory;
use App\Models\Course;
use App\Models\Task;
use App\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $users_count      = User::all()->count();
        $tasks_count      = Task::all()->count();
        $advisories_count = Advisory::all()->count();
        $courses_count    = Course::all()->count();

        return view('admin.index',[
            'users_count'      => $users_count,
            'tasks_count'      => $tasks_count,
            'advisories_count' => $advisories_count,
            'courses_count'    => $courses_count,
        ]);
    }
}
