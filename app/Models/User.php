<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'image',
        'role_id',
        'phone-number',
        'address'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    
    public function role() {
        return $this->belongsTo(Role::class);
    }

    public function courses() {
        return $this->belongsToMany(Course::class, 'user_course')->withTimestamps();
    }
    
    public function exams() {
        return $this->belongsToMany(Exam::class, 'user_exam')->withPivot('score', 'time_minutes', 'finished')->withTimestamps();
    }

    public function questions() {
        return $this->belongsToMany(Question::class, 'user_question')->withPivot('exam_id', 'answer', 'correct')->withTimestamps();
    }
}
