<?php

namespace App\Http\Controllers;

use App\Models\UserCourse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CourseController extends Controller
{
    public function index()
    {
        
        $userCourses = UserCourse::where('user_id', Auth::id())
                                 ->with(['course', 'progress'])
                                 ->get();

        return view('courses.index', compact('userCourses'));
    }
    
    public function show($id)
    {
        //
    }
}