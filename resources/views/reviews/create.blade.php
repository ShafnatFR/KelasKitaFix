@extends('layouts.app')

@section('title', 'Tulis Review - ' . $course->title)

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-xl mx-auto bg-white rounded-xl shadow-2xl p-8 border border-gray-200">
        
   
        <h1 class="text-3xl font-bold text-blue-800 mb-6">Tulis Review untuk <span class="text-blue-600">{{ $course->title }}</span></h1>
        
        @if (session('error'))
            <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative">
                {{ session('error') }}
            </div>
        @endif
        
        <form action="{{ route('reviews.store', $course->id) }}" method="POST">
            @csrf

            <div class="mb-5">
                <label for="rating" class="block text-gray-700 font-semibold mb-2">Rating (1-5)</label>
                <div class="flex items-center space-x-1" id="star-rating">
                    @for ($i = 1; $i <= 5; $i++)
                        <i class="fas fa-star text-gray-300 text-2xl cursor-pointer rating-star" data-rating="{{ $i }}"></i>
                    @endfor
                </div>
                <input type="hidden" name="rating" id="rating-input" required>
                @error('rating')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
               
                <label for="comment" class="block text-gray-700 font-semibold mb-2">Komentar Anda (Opsional)</label>
                <textarea name="comment" id="comment" rows="5" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 resize-none" placeholder="Bagikan pengalaman Anda..."></textarea>
                @error('comment')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

          
            <button type="submit" class="w-full bg-blue-600 text-white font-semibold py-3 rounded-lg hover:bg-blue-700 transition">
                Kirim Review
            </button>
        </form>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const stars = document.querySelectorAll('.rating-star');
    const ratingInput = document.getElementById('rating-input');

    stars.forEach(star => {
        star.addEventListener('click', () => {
            const rating = parseInt(star.dataset.rating);
            ratingInput.value = rating;

            stars.forEach(s => {
                const sRating = parseInt(s.dataset.rating);
                if (sRating <= rating) {
                    s.classList.remove('text-gray-300');
                    s.classList.add('text-yellow-500');
                } else {
                    s.classList.remove('text-yellow-500');
                    s.classList.add('text-gray-300');
                }
            });
        });
    });
});
</script>
@endpush
@endsection