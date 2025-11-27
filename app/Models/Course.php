<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'image',
        'total_lessons',
        'price'
    ];

    public function userCourses()
    {
        return $this->hasMany(UserCourse::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_courses');
    }

    public function averageRating()
    {
        return $this->reviews()->avg('rating') ?? 0;
    }
}