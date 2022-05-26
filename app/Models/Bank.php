<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bank extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];

    public function course() {
        return $this->belongsTo(Course::class);
    }

    public function exams() {
        return $this->belongsToMany(Exam::class, 'exam_bank')->withPivot('number_of_questions');
    }

    public function questions() {
        return $this->hasMany(Question::class);
    }
}
