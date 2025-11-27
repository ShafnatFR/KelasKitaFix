<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserCourse extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'course_id',
        'progress_percentage',
        'enrolled_at'
    ];

    protected $casts = [
        'enrolled_at' => 'datetime'
    ];
    
    protected $appends = ['calculated_progress_percentage'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function progress()
    {
        return $this->hasMany(CourseProgress::class);
    }
    

    public function getCalculatedProgressPercentageAttribute()
    {
        $this->loadMissing('progress');
        
        $totalLessons = $this->progress->count();
        $completedLessons = $this->progress->where('is_completed', true)->count();

        if ($totalLessons == 0) {
            return 0;
        }

        return round(($completedLessons / $totalLessons) * 100);
    }
}