<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReservationVehicle extends Model
{
    use HasFactory;
    
    public function reservation(): BelongsTo
    {
        return $this->belongsTo(Reservation::class, 'reservation_id');
    }
    public function vehicles(): BelongsTo
    {
        return $this->belongsTo(Vehicles::class, 'vehicle_id');
    }
    public function drivers(): BelongsTo
    {
        return $this->belongsTo(Drivers::class, 'driver_id');
    }
}
