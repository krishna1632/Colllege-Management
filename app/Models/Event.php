<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $table = 'event_news'; // Manually specify table name
    public $timestamps = false; // Disable timestamps if your table doesn't have them

    protected $fillable = [
        'event_name', 'convenor', 'mob', 'place', 'date', 'time','intro_event'
    ];
    
}
