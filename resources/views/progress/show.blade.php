@extends('layouts.app')

@section('title', 'Progress - ' . $userCourse->course->title)

@section('content')
<div class="container mx-auto px-4 py-8">

    <div class="mb-6">
        <a href="{{ route('courses.index') }}" class="text-blue-600 hover:text-blue-800 flex items-center">
            <i class="fas fa-arrow-left mr-2"></i>Back to My Courses
        </a>
    </div>

    <div class="bg-white rounded-xl shadow-2xl overflow-hidden border border-gray-200">
        <div class="bg-gradient-to-r from-blue-600 to-blue-800 text-white p-8">
            <h1 class="text-3xl font-bold mb-2">{{ $userCourse->course->title }}</h1>
            <p class="text-blue-100 mb-4">{{ $userCourse->course->description }}</p>
            
            <div class="flex items-center space-x-6">
                <div class="bg-white/20 backdrop-blur-sm rounded-lg px-5 py-3 border border-white/30">
                    <span class="text-sm">Current Progress</span>
                    <p class="text-3xl font-extrabold" id="progress-percentage">{{ $userCourse->calculated_progress_percentage }}%</p>
                </div>
                <div class="bg-white/20 backdrop-blur-sm rounded-lg px-5 py-3 border border-white/30">
                    <span class="text-sm">Completed Lessons</span>
                    <p class="text-3xl font-extrabold">
                        <span id="completed-count">{{ $userCourse->progress->where('is_completed', true)->count() }}</span>/{{ $userCourse->progress->count() }}
                    </p>
                </div>
            </div>
        </div>

        <div class="px-8 py-4 bg-gray-50 border-b">
            <div class="w-full bg-gray-200 rounded-full h-3">
                
                @php
                    $progress = $userCourse->calculated_progress_percentage;
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

                <div id="progress-bar"
                     class="bg-blue-600 h-3 rounded-full transition-all duration-500 {{ $widthClass }}"></div>
            </div>
        </div>

        <div class="p-8">
            <h2 class="text-2xl font-bold text-gray-800 mb-6">Course Lessons</h2>
            
            <div class="space-y-4">
                @foreach($userCourse->progress as $lesson)
                    {{-- Ganti href="#" dengan route yang benar jika View Lessons Detail dibuat --}}
                    <a href="#" class="flex items-center p-4 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors lesson-item border border-gray-200">
                        
                        <input type="checkbox" 
                                class="lesson-checkbox w-6 h-6 text-blue-600 rounded focus:ring-blue-500 cursor-pointer border-gray-300"
                                data-progress-id="{{ $lesson->id }}"
                                {{ $lesson->is_completed ? 'checked' : '' }}
                                onclick="event.stopPropagation()">
                        
                        <div class="ml-4 flex-1">
                            <h3 class="font-semibold text-lg text-gray-800 lesson-title {{ $lesson->is_completed ? 'line-through text-gray-500' : '' }}">
                                {{ $lesson->lesson_title }}
                                {{-- PERBAIKAN: Menghilangkan span (Video/Materi Tersedia) --}}
                            </h3>
                            <p class="text-sm text-gray-500">Lesson {{ $lesson->lesson_number }}</p>
                        </div>

                        @if($lesson->is_completed)
                            <span class="bg-green-100 text-green-800 text-xs font-semibold px-3 py-1 rounded-full badge-completed ml-3">
                                <i class="fas fa-check mr-1"></i>Completed
                            </span>
                        @endif
                    </a>
                @endforeach
            </div>

            <div class="mt-10 flex space-x-4">
                @if($userCourse->calculated_progress_percentage == 100)
                    <a href="{{ route('reviews.create', $userCourse->course_id) }}" 
                       class="bg-yellow-500 text-white px-6 py-3 rounded-lg hover:bg-yellow-600 transition font-semibold flex items-center">
                        <i class="fas fa-star mr-2"></i>Tulis Review
                    </a>
                @else
                    <button class="bg-gray-300 text-gray-600 px-6 py-3 rounded-lg font-semibold cursor-not-allowed flex items-center" disabled>
                        <i class="fas fa-star mr-2"></i>Selesaikan Kursus untuk Review
                    </button>
                @endif

                <form method="POST" action="{{ route('progress.reset', $userCourse->course_id) }}" 
                      onsubmit="return confirm('Apakah Anda yakin ingin mengatur ulang progres Anda?')">
                    @csrf
                    <button type="submit" class="bg-red-100 text-red-700 px-6 py-3 rounded-lg hover:bg-red-200 transition font-semibold flex items-center">
                        <i class="fas fa-redo mr-2"></i>Atur Ulang Progres
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
// Fungsi untuk memetakan persentase ke class lebar Tailwind
function getTailwindWidthClass(percentage) {
    if (percentage >= 100) return 'w-full';
    if (percentage > 90) return 'w-[95%]';
    if (percentage > 80) return 'w-4/5';
    if (percentage > 70) return 'w-[75%]';
    if (percentage > 60) return 'w-3/5';
    if (percentage > 50) return 'w-1/2';
    if (percentage > 40) return 'w-[45%]';
    if (percentage > 30) return 'w-2/5';
    if (percentage > 20) return 'w-1/4';
    if (percentage > 10) return 'w-1/5';
    if (percentage > 0) return 'w-[5%]';
    return 'w-0';
}

document.addEventListener('DOMContentLoaded', function() {
    // Targetkan checkbox
    const checkboxes = document.querySelectorAll('.lesson-checkbox');
    const csrfToken = document.querySelector('meta[name="csrf-token"]').content;
    
    checkboxes.forEach(checkbox => {
        // Gunakan event 'change' pada checkbox
        checkbox.addEventListener('change', function() {
            const progressId = this.dataset.progressId;
            const isChecked = this.checked; 
            const lessonItem = this.closest('a'); 
            const lessonTitle = lessonItem.querySelector('.lesson-title');
            
            this.disabled = true;
            
            fetch(`/progress/${progressId}/toggle`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken
                },
                body: JSON.stringify({})
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    const progressBar = document.getElementById('progress-bar');
                    const progressPercentageElement = document.getElementById('progress-percentage');
                    const completedCount = document.getElementById('completed-count');
                    
                    const newWidthClass = getTailwindWidthClass(data.progress_percentage);
                    
                    // Update Progress Bar
                    progressBar.className = progressBar.className.replace(/w-\[\d+%\]|w-\d\/\d|w-\d\/\d|w-full|w-0/g, ''); 
                    progressBar.classList.add(newWidthClass); 
                    
                    progressPercentageElement.textContent = data.progress_percentage + '%';
                    completedCount.textContent = data.completed_count;

                    // Update UI Lesson Status
                    if (data.is_completed) {
                        lessonTitle.classList.add('line-through', 'text-gray-500');
                        lessonTitle.classList.remove('text-gray-800');
                        
                        // Tambahkan Badge Completed
                        const badge = document.createElement('span');
                        badge.className = 'bg-green-100 text-green-800 text-xs font-semibold px-3 py-1 rounded-full badge-completed ml-3';
                        badge.innerHTML = '<i class="fas fa-check mr-1"></i>Completed';
                        lessonItem.appendChild(badge);

                    } else {
                        lessonTitle.classList.remove('line-through', 'text-gray-500');
                        lessonTitle.classList.add('text-gray-800');
                        
                        // Hapus Badge Completed
                        let existingBadge = lessonItem.querySelector('.badge-completed');
                        if (existingBadge) existingBadge.remove();
                    }
                    
                    if (data.progress_percentage == 100) {
                        setTimeout(() => location.reload(), 500);
                    }
                }
                this.disabled = false;
            })
            .catch(error => {
                console.error('Error:', error);
                this.checked = !isChecked; 
                this.disabled = false;
                alert('Gagal memperbarui progres. Cek console untuk detail.');
            });
        });
    });
});
</script>
@endpush
@endsection