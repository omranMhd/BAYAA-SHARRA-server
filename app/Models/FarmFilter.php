<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FarmFilter extends Model
{
    use HasFactory;

    protected $table = 'farm_filters';

    protected $fillable = [
    'advertisement_id',
    'area',
    'roomCount',
    'cladding',
    'floorCount',
    'price',
    'newPrice',
    'currency',
    'ownership',
    'sellOrRent',
    'paymentMethodRent',
    'direction',
];

    public function advertisement()
    {
        return $this->belongsTo(Advertisement::class, 'advertisement_id', 'id');
    }
}
