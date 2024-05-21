<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ComputerFilter extends Model
{
    use HasFactory;

    protected $table = 'computer_filters';

    protected $fillable = [
        'advertisement_id',
        'price',
        'newPrice',
        'currency',
        'brand',
        'category',
        'ram',
        'hard',
        'processor',
        'status',
        'screenType',
        'screenSize',
    ];

    public function advertisement()
    {
        return $this->belongsTo(Advertisement::class, 'advertisement_id', 'id');
    }
}
