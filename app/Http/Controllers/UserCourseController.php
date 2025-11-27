<?php

namespace App\Http\Controllers;

use App\Models\UserCourse;
use App\Models\CourseProgress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserCourseController extends Controller
{
  

    public function show(UserCourse $userCourse)
    {
        if ($userCourse->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

       
        $userCourse->load('course', 'progress');
        $userCourse->progress_percentage = $userCourse->calculated_progress_percentage;

        return view('progress.show', compact('userCourse'));
    }

    public function toggleProgress(CourseProgress $courseProgress)
    {
        if ($courseProgress->userCourse->user_id !== Auth::id()) {
            return response()->json(['success' => false, 'message' => 'Unauthorized action.'], 403);
        }

        $courseProgress->is_completed = !$courseProgress->is_completed;
        $courseProgress->save();

        $userCourse = $courseProgress->userCourse;
        $userCourse->load('progress');
        
        $progressPercentage = $userCourse->calculated_progress_percentage;
        $completedLessons = $userCourse->progress->where('is_completed', true)->count();
        
        return response()->json([
            'success' => true,
            'is_completed' => $courseProgress->is_completed,
            'progress_percentage' => $progressPercentage,
            'completed_count' => $completedLessons,
        ]);
    }
    
    public function resetProgress($courseId)
    {
        $user = Auth::user();

        $userCourse = UserCourse::where('user_id', $user->id)
                                ->where('course_id', $courseId)
                                ->firstOrFail();

        $userCourse->progress()->update(['is_completed' => false]);
        
        return redirect()->route('user-courses.show', $userCourse->id)
                         ->with('success', 'Progress kursus berhasil direset.');
    }
}