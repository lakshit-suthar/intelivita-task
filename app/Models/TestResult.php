<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TestResult extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['user_id', 'question_id', 'answer_id'];

    // Relationships belongsTo
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relationships belongsTo
    public function question()
    {
        return $this->belongsTo(Question::class);
    }

    // Relationships belongsTo
    public function answer()
    {
        return $this->belongsTo(Answer::class);
    }
}
