<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RestDevicesFilters extends Model
{
    use HasFactory;

    protected $table = 'rest_devices_filters';

    protected $fillable = [
        'advertisement_id',
        'price',
        'newPrice',
        'currency',
        'deviceStatus',
    ];
}
