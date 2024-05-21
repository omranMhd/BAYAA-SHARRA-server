<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SparePartsVehicleFilters extends Model
{
    use HasFactory;

    protected $table = 'spare_parts_vehicle_filters';

    protected $fillable = [
        'advertisement_id',
        'price',
        'newPrice',
        'currency',
        'vehicleType',
        'status',
    
    ];

    public function advertisement()
    {
        return $this->belongsTo(Advertisement::class, 'advertisement_id', 'id');
    }
}
