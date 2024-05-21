<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OfficeFilter extends Model
{
    use HasFactory;

    protected $table = 'office_filters';

    protected $fillable = [
        'advertisement_id',
        'area',
        'floor',
        'roomCount',
        'cladding',
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
