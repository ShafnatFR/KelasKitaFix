<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseProgress extends Model
{
    use HasFactory;

    protected $table = 'course_progresses'; 
    protected $fillable = [
        'user_course_id',
        'lesson_number', 
        'lesson_title', 
        'is_completed',
    ];

   
    protected $casts = [
        'is_completed' => 'boolean',
    ];

   
    public function userCourse()
    {
        
        return $this->belongsTo(UserCourse::class);
    }
}