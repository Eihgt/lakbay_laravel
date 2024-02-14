<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Offices extends Model
{
    
    use HasFactory;
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $primaryKey = 'off_id';
    protected $fillable=[
        'off_id',
        'off_acr',
        'off_name',
        'off_head',
    ];
}
