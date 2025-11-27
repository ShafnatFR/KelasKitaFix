@extends('layouts.app')

@section('title', 'My Courses')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-4xl font-extrabold text-blue-800 mb-8 border-b-4 border-blue-500 pb-2">My Courses</h1>

    @if($userCourses->isEmpty())
        <div class="bg-blue-50 border-l-4 border-blue-500 text-blue-700 p-4" role="alert">
            <p class="font-bold">No Courses Enrolled</p>
            <p>You haven't enrolled in any courses yet.</p>
        </div>
    @else
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($userCourses as $userCourse)
                <div class="bg-white rounded-xl shadow-lg hover:shadow-xl transition duration-300 overflow-hidden">
                    <div class="p-6">
                        <h2 class="text-2xl font-bold text-gray-800 mb-2">{{ $userCourse->course->title }}</h2>
                        <p class="text-gray-600 mb-4 line-clamp-3">{{ $userCourse->course->description }}</p>
                        
                        <div class="mb-4">
                            @php
                                // Ambil persentase dari Accessor Model
                                $progress = $userCourse->calculated_progress_percentage;
                                
                                // Tentukan class lebar berdasarkan interval persentase (Contoh Tailwind Classes)
                                $widthClass = 'w-0';
                                if ($progress >= 100) $widthClass = 'w-full';
                                elseif ($progress > 90) $widthClass = 'w-[95%]';
                                elseif ($progress > 80) $widthClass = 'w-4/5';
                                elseif ($progress > 70) $widthClass = 'w-[75%]';
                                elseif ($progress > 60) $widthClass = 'w-3/5';
                                elseif ($progress > 50) $widthClass = 'w-1/2';
                                elseif ($progress > 40) $widthClass = 'w-[45%]';
                                elseif ($progress > 30) $widthClass = 'w-2/5';
                                elseif ($progress > 20) $widthClass = 'w-1/4';
                                elseif ($progress > 10) $widthClass = 'w-1/5';
                                elseif ($progress > 0) $widthClass = 'w-[5%]';
                            @endphp

                            <span class="text-sm font-semibold text-blue-600">Progress: {{ $progress }}%</span>
                            <div class="w-full bg-gray-200 rounded-full h-2.5 mt-1">
                                {{-- FIX: MENGGUNAKAN CONDITIONAL TAILWIND CLASS --}}
                                <div class="bg-blue-600 h-2.5 rounded-full {{ $widthClass }}"></div>
                            </div>
                        </div>

                        <a href="{{ route('user-courses.show', $userCourse->id) }}" class="inline-block bg-blue-600 text-white font-semibold py-2 px-4 rounded-lg hover:bg-blue-700 transition">
                            Continue Learning
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection