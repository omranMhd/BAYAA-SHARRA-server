<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RealEstateFilter extends Model
{
    use HasFactory;

    protected $table = 'real_estate_filters';

    protected $fillable = [
        'advertisement_id',
        'area',
        'areaUnit',
        'floor',
        'cladding',
        'sellOrRent',
    ];

    public function advertisement()
    {
        return $this->belongsTo(Advertisement::class, 'advertisement_id', 'id');
    }
}
