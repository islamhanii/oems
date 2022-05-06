<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'code',
        'description',
        'image',
        'status'
    ];

    public function courses() {
        return $this->belongsToMany(User::class, 'user_course')->withPivot('created_at');
    }

    public function banks() {
        return $this->hasMany(Bank::class);
    }

    public function exams() {
        return $this->hasMany(Exam::class);
    }
}
