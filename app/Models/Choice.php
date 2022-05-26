<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Choice extends Model
{
    use HasFactory;

    public $timestamps = false;
    
    protected $fillable = [
        'option',
        'image',
        'right_answer'
    ];

    public function question() {
        return $this->belongsTo(Question::class);
    }
}
