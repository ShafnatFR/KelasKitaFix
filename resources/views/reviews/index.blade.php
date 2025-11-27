@extends('layouts.app')

@section('title', 'Reviews - ' . $course->title)

@section('content')
<div class="container mx-auto px-4 py-8">
    
 
    <div class="mb-6"> 
        <a href="{{ route('courses.index') }}" class="text-blue-600 hover:text-blue-800 flex items-center">
            <i class="fas fa-arrow-left mr-2"></i>Back to My Courses
        </a>
    </div>

   
    <div class="bg-white rounded-xl shadow-2xl p-8 border border-gray-200">
        <h1 class="text-3xl font-bold text-blue-800 mb-2">{{ $course->title }} Reviews</h1>
        <p class="text-gray-600 mb-6">Read what others think about this course.</p>
        
        <div class="mb-6 flex space-x-4">
            @php
                $userReview = $reviews->where('user_id', Auth::id())->first();
            @endphp

            @if ($userReview)
                <a href="{{ route('reviews.edit', $course->id) }}" class="bg-blue-600 text-white font-semibold py-2 px-4 rounded-lg hover:bg-blue-700 transition flex items-center">
                    <i class="fas fa-edit mr-2"></i>Edit My Review
                </a>
                <form action="{{ route('reviews.destroy', $course->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete your review?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-red-500 text-white font-semibold py-2 px-4 rounded-lg hover:bg-red-600 transition flex items-center">
                        <i class="fas fa-trash-alt mr-2"></i>Delete Review
                    </button>
                </form>
            @endif
        </div>

        <div class="space-y-6">
            @forelse($reviews as $review)
                <div class="border border-gray-200 p-4 rounded-lg shadow-sm {{ $review->user_id == Auth::id() ? 'bg-blue-50 border-blue-300' : 'bg-white' }}">
                    <div class="flex justify-between items-start mb-2">
                        <div>
                            <p class="font-semibold text-gray-800">{{ $review->user->name }}</p>
                            <div class="flex items-center">
                                @for ($i = 1; $i <= 5; $i++)
                                    <i class="fas fa-star text-sm {{ $i <= $review->rating ? 'text-yellow-500' : 'text-gray-300' }}"></i>
                                @endfor
                                <span class="ml-2 text-sm text-gray-500">{{ $review->created_at->diffForHumans() }}</span>
                            </div>
                        </div>
                        @if ($review->user_id == Auth::id())
                             <span class="text-xs font-bold text-blue-600 bg-blue-200 px-3 py-1 rounded-full">Your Review</span>
                        @endif
                    </div>
                    <p class="text-gray-700 italic">{{ $review->comment ?? 'No comment provided.' }}</p>
                </div>
            @empty
                <div class="bg-gray-100 border-l-4 border-gray-500 text-gray-700 p-4" role="alert">
                    <p>Be the first one to review this course!</p>
                </div>
            @endforelse
        </div>
    </div>
</div>
@endsection