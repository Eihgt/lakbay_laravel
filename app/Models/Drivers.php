<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Drivers extends Model
{
    use HasFactory;
    protected $fillable=[
        'dr_emp_id',
        'dr_name',
        'dr_office',
        'dr_status',
    ];
}
