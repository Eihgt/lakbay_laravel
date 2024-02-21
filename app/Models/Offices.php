<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Drivers;
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
    public function drivers(): HasMany
    {
        return $this->hasMany(Drivers::class,'off_id');
    }
}
