<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $fillable = [
        'header',
        'diffculty'
    ];
    
    public function users() {
        return $this->belongsToMany(User::class, 'user_question')->withPivot('exam_id', 'answer', 'correct')->withTimestamps();
    }

    public function exams() {
        return $this->belongsToMany(Exam::class, 'exam_question');
    }

    public function bank() {
        return $this->belongsTo(Bank::class);
    }

    public function choices() {
        return $this->hasMany(Choice::class);
    }

    public function images() {
        return $this->hasMany(Image::class);
    }
}
