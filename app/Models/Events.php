<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Events extends Model
{
    use HasFactory;
    protected $primaryKey = 'event_id';
    protected $fillable=[
        'ev_name',
        'ev_venue',
        'ev_date_start',
        'ev_time_start',
        'ev_date_end',
        'ev_time_end',
    ];
}
