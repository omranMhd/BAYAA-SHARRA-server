<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommonVehicleFilters extends Model
{
    use HasFactory;

    protected $table = 'common_vehicle_filters';

    protected $fillable = [
        'advertisement_id',
        'brand',
        'model',
        'color',
        'gear',
        'manufactureYear',
        'traveledDistance',
        'engineCapacity',
        'fuel',
        'price',
        'newPrice',
        'currency',
        'paymentMethodRent',
        'sellOrRent',
        'paintStatus',
    ];

    public function advertisement()
    {
        return $this->belongsTo(Advertisement::class, 'advertisement_id', 'id');
    }
}
