<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Advertisement extends Model
{
    use HasFactory;

    protected $table = 'advertisements';

    protected $fillable = [
        'user_id',
        'category_id',
        'address',
        'location',
        'title',
        'description',
        'contactNumber',
        'price',
        'newPrice',
        'currency',
        'status',
        'paidFor',
    ];

    public function images()
    {
        return $this->hasMany(Image::class, 'advertisement_id', 'id');
    }

    public function complaints()
    {
        return $this->hasMany(Complaint::class, 'advertisement_id', 'id');
    }
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }
    public function vehicleFilter()
    {
        return $this->hasOne(VehicleFilter::class, 'advertisement_id', 'id');
    }
    public function clothesFashionFilter()
    {
        return $this->hasOne(ClothesFasionFilter::class, 'advertisement_id', 'id');
    }
    public function electronicElectricalFilter()
    {
        return $this->hasOne(ElectronicElectricalFilter::class, 'advertisement_id', 'id');
    }
    public function realEstateFilter()
    {
        return $this->hasOne(RealEstateFilter::class, 'advertisement_id', 'id');
    }
    public function furnitureFilters()
    {
        return $this->hasOne(FurnitureFilter::class, 'advertisement_id', 'id');
    }
    public function favorites()
    {
        return $this->hasMany(Favorite::class, 'advertisement_id', 'id');
    }
    public function comments()
    {
        return $this->hasMany(Comment::class, 'advertisement_id', 'id');
    }
    public function likes()
    {
        return $this->hasMany(Like::class, 'advertisement_id', 'id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

}
