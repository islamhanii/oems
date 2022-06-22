<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    use HasFactory;

    protected $guarded = [
        'id',
        'course_id',
        'created_at',
        'updated_at'
    ];

    public function users() {
        return $this->belongsToMany(User::class, 'user_exam')->withPivot('score', 'time_minutes', 'finished')->withTimestamps();
    }

    public function course() {
        return $this->belongsTo(Course::class);
    }

    public function banks() {
        return $this->belongsToMany(Bank::class, 'exam_bank')->withPivot('number_of_questions');
    }

    public function questions() {
        return $this->belongsToMany(Question::class, 'exam_question');
    }
}
