<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ElectronicElectricalFilter extends Model
{
    use HasFactory;

    protected $table = 'electronic_electrical_filters';

    protected $fillable = [
        'advertisement_id',
        'oldOrNew',
    ];

    public function advertisement()
    {
        return $this->belongsTo(Advertisement::class, 'advertisement_id', 'id');
    }
}
