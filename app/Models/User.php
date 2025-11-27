<?php

namespace App\Models;

// 1. Tambahkan use statement untuk trait otentikasi dan notifikasi (jika ada)
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable; // <-- IMPORT CLASS INI
use Illuminate\Notifications\Notifiable; // Opsional, tapi umum

// 2. Ubah inheritance dari Model menjadi Authenticatable
class User extends Authenticatable // <-- PENTING!
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
}