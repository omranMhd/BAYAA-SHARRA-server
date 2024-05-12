<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MobTabFilter extends Model
{
    use HasFactory;

    protected $table = 'mob_tab_filters';

    protected $fillable = ['*'];

    public function advertisement()
    {
        return $this->belongsTo(Advertisement::class, 'advertisement_id', 'id');
    }
}
