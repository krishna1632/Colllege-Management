<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    use HasFactory;

    protected $fillable = [
        'test_name',
        'test_date',
        'start_time', // Updated
        'end_time', // Updated
        'status',
    ];

    // If you plan to have a relationship with questions, you can add this method later
    public function questions()
    {
        return $this->hasMany(Question::class);
    }
}