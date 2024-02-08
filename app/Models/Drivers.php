<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Drivers extends Model
{
    use HasFactory;
    protected $primaryKey = 'driver_id';
    protected $fillable=[
        'driver_id',
        'dr_emp_id',
        'dr_name',
        'dr_office',
        'dr_status',
    ];
}
