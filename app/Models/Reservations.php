<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Events;
use App\Models\Drivers;
use App\Models\Requestors;
use App\Models\Vehicles;

class Reservations extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $primaryKey = 'reservation_id';
    protected $fillable=[
        'rs_voucher',
        'rs_daily_transport',
        'rs_outside_province',
        'rs_date_filed',
        'rs_approval_status',
        'rs_status',
        'event_id',
        'driver_id',
        'vehicle_id',
        'requestor_id'
    ];
    public function events(): BelongsTo
    {
        return $this->belongsTo(Events::class, 'event_id');
    }
    public function drivers(): BelongsTo
    {
        return $this->belongsTo(Drivers::class, 'driver_id');
    }
    public function vehicles(): BelongsTo
    {
        return $this->belongsTo(Vehicle::class, 'vehicle_id');
    }
    public function requestors(): BelongsTo
    {
        return $this->belongsTo(Requestors::class, 'requestor_id');
    }

}
