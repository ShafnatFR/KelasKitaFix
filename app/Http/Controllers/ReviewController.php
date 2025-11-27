<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function index($courseId)
    {
        $course = Course::findOrFail($courseId);
        $reviews = Review::where('course_id', $courseId)->with('user')->get();
        
        return view('reviews.index', compact('course', 'reviews'));
    }

    public function create($courseId)
    {
        $course = Course::findOrFail($courseId);
        $existingReview = Review::where('user_id', Auth::id())
                                ->where('course_id', $courseId)
                                ->first();

        if ($existingReview) {
            return redirect()->route('reviews.edit', $courseId);
        }

        return view('reviews.create', compact('course'));
    }

    public function store(Request $request, $courseId)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:1000',
        ]);

        Review::create([
            'user_id' => Auth::id(),
            'course_id' => $courseId,
            'rating' => $request->rating,
            'comment' => $request->comment,
        ]);

        return redirect()->route('reviews.index', $courseId)->with('success', 'Review berhasil ditambahkan!');
    }

    public function edit($courseId)
    {
        $course = Course::findOrFail($courseId);
        $review = Review::where('user_id', Auth::id())
                        ->where('course_id', $courseId)
                        ->firstOrFail();

        return view('reviews.edit', compact('course', 'review'));
    }

    public function update(Request $request, $courseId)
    {
        $review = Review::where('user_id', Auth::id())
                        ->where('course_id', $courseId)
                        ->firstOrFail();

        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:1000',
        ]);
        
        $review->update([
            'rating' => $request->rating,
            'comment' => $request->comment,
        ]);

        return redirect()->route('reviews.index', $courseId)->with('success', 'Review berhasil diperbarui!');
    }

    public function destroy($courseId)
    {
        $review = Review::where('user_id', Auth::id())
                        ->where('course_id', $courseId)
                        ->firstOrFail();
        
        $review->delete();

        return redirect()->route('reviews.index', $courseId)->with('success', 'Review berhasil dihapus.');
    }
}