<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VehicleFilter extends Model
{
    use HasFactory;

    protected $table = 'vehicle_filters';

    protected $fillable = [
        'advertisement_id',
        'oldOrNew',
        'traveledDistance',
        'sellOrRent',
        'fuelType',
    ];

    public function advertisement()
    {
        return $this->belongsTo(Advertisement::class, 'advertisement_id', 'id');
    }
}
