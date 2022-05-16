<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $guarded = [
        'id',
        'created_at',
        'updated_at'
    ];

    protected $hidden = [
        'access_code'
    ];

    public function users() {
        return $this->belongsToMany(User::class, 'user_course')->withTimestamps();
    }

    public function banks() {
        return $this->hasMany(Bank::class);
    }

    public function exams() {
        return $this->hasMany(Exam::class);
    }
}
