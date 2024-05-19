<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['question_text', 'time_limit'];

    // Relationships hasMany
    public function answers()
    {
        return $this->hasMany(Answer::class);
    }

    // Relationships hasMany
    public function testResults()
    {
        return $this->hasMany(TestResult::class);
    }
}
