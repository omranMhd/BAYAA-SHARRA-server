<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClothesFasionFilter extends Model
{
    use HasFactory;

    protected $table = 'clothes_fashion_filters';

    protected $fillable = [
        'advertisement_id',
        'price',
        'newPrice',
        'currency',
        'status',
        'type',
    ];

    public function advertisement()
    {
        return $this->belongsTo(Advertisement::class, 'advertisement_id', 'id');
    }
}
