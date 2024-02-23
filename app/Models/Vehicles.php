<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Vehicles extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $primaryKey = 'vehicle_id';
    protected $fillable=[
        'vh_plate',
        'vh_type',
        'vh_brand',
        'vh_year',
        'vh_fuel_type',
        'vh_condition',
        'vh_status',
    ];
    public function reservations(): HasMany
    {
        return $this->hasMany(Reservations::class,'vehicle_id');
    }

}
