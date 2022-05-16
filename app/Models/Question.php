<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $fillable = [
        'header',
        'images',
        'diffculty'
    ];
    
    public function users() {
        return $this->belongsToMany(User::class, 'user_question')->withPivot('answer', 'correct')->withTimestamps();
    }

    public function bank() {
        return $this->belongsTo(Bank::class);
    }

    public function choices() {
        return $this->hasMany(Choice::class);
    }
}
