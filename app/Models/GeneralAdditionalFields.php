<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GeneralAdditionalFields extends Model
{
    use HasFactory;

    protected $table = 'general_additional_fields';

    protected $fillable = [
        'advertisement_id',
        'price',
        'newPrice',
        'currency',
    ];
}
