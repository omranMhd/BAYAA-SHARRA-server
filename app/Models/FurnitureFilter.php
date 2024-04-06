<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FurnitureFilter extends Model
{
    use HasFactory;

    protected $table = 'furniture_filters';

    protected $fillable = [
        'advertisement_id',
        'oldOrNew',
    ];

    public function advertisement()
    {
        return $this->belongsTo(Advertisement::class, 'advertisement_id', 'id');
    }
}
