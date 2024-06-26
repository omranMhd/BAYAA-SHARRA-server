<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommercialStoresFilter extends Model
{
    use HasFactory;

    protected $table = 'commercial_stores_filters';

    protected $fillable = [
        'advertisement_id',
        'area',
        'floor',
        'cladding',
        'price',
        'newPrice',
        'currency',
        'ownership',
        'sellOrRent',
        'paymentMethodRent',
    ];

    public function advertisement()
    {
        return $this->belongsTo(Advertisement::class, 'advertisement_id', 'id');
    }
}
