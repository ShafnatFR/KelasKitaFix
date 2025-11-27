<?php

namespace App\Http\Controllers;

use App\Models\UserCourse;
use App\Models\CourseProgress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CourseProgressController extends Controller
{
   
    public function show($courseId)
    {
        $userCourse = UserCourse::where('user_id', Auth::id())
            ->where('course_id', $courseId)
            ->with(['course', 'progress'])
            ->firstOrFail();

        return view('progress.show', compact('userCourse'));
    }

    public function toggleLesson(Request $request, $progressId)
    {
        $progress = CourseProgress::findOrFail($progressId);
        
       
        if ($progress->userCourse->user_id !== Auth::id()) {
            abort(403);
        }

        $progress->is_completed = !$progress->is_completed;
        $progress->save();

       
        $this->updateProgressPercentage($progress->user_course_id);

        return response()->json([
            'success' => true,
            'is_completed' => $progress->is_completed,
            'progress_percentage' => $progress->userCourse->fresh()->progress_percentage
        ]);
    }

   
    private function updateProgressPercentage($userCourseId)
    {
        $userCourse = UserCourse::findOrFail($userCourseId);
        $totalLessons = $userCourse->progress()->count();
        $completedLessons = $userCourse->progress()->where('is_completed', true)->count();
        
        $percentage = $totalLessons > 0 ? round(($completedLessons / $totalLessons) * 100) : 0;
        
        $userCourse->progress_percentage = $percentage;
        $userCourse->save();
    }

   
    public function reset($courseId)
    {
        $userCourse = UserCourse::where('user_id', Auth::id())
            ->where('course_id', $courseId)
            ->firstOrFail();

        $userCourse->progress()->update(['is_completed' => false]);
        $userCourse->progress_percentage = 0;
        $userCourse->save();

        return redirect()->route('progress.show', $courseId)
            ->with('success', 'Progress berhasil direset!');
    }
}