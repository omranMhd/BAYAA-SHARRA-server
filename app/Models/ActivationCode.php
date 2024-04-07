<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActivationCode extends Model
{
    use HasFactory;

    protected $table = 'activation_codes';

    protected $fillable = [
        'user_id',
        'code',
        'is_used',
        'verified_by'
        
    ];
}
