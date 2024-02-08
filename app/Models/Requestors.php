<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Requestors extends Model
{
    use HasFactory;
    protected $primaryKey = 'requestor_id';
    protected $fillable = [
        'rq_full_name',
        'rq_office',
    ];
}
