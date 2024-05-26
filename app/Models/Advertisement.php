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

    public function clothesFashionFilter()
    {
        return $this->hasOne(ClothesFasionFilter::class, 'advertisement_id', 'id');
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
    public function apartementFilter()
    {
        return $this->hasOne(ApartementFilter::class, 'advertisement_id', 'id');
    }
    public function farmFilter()
    {
        return $this->hasOne(FarmFilter::class, 'advertisement_id', 'id');
    }
    public function landFilter()
    {
        return $this->hasOne(LandFilter::class, 'advertisement_id', 'id');
    }
    public function commercialStoreFilter()
    {
        return $this->hasOne(CommercialStoresFilter::class, 'advertisement_id', 'id');
    }
    public function officeFilter()
    {
        return $this->hasOne(OfficeFilter::class, 'advertisement_id', 'id');
    }
    public function shalehFilter()
    {
        return $this->hasOne(ShalehFilter::class, 'advertisement_id', 'id');
    }
    public function vellaFilter()
    {
        return $this->hasOne(VellaFilter::class, 'advertisement_id', 'id');
    }
    public function commonVehicleFilter()
    {
        return $this->hasOne(CommonVehicleFilters::class, 'advertisement_id', 'id');
    }
    public function sparePartsVehicleFilter()
    {
        return $this->hasOne(SparePartsVehicleFilters::class, 'advertisement_id', 'id');
    }
    public function mobTabFilter()
    {
        return $this->hasOne(MobTabFilter::class, 'advertisement_id', 'id');
    }
    public function computerFilter()
    {
        return $this->hasOne(ComputerFilter::class, 'advertisement_id', 'id');
    }
    public function execoarFilter()
    {
        return $this->hasOne(ExecoarFilter::class, 'advertisement_id', 'id');
    }
    public function restDevicesFilter()
    {
        return $this->hasOne(RestDevicesFilters::class, 'advertisement_id', 'id');
    }
    public function furnitureFilter()
    {
        return $this->hasOne(FurnitureFilter::class, 'advertisement_id', 'id');
    }
    public function clothesFasionFilter()
    {
        return $this->hasOne(ClothesFasionFilter::class, 'advertisement_id', 'id');
    }
    public function generalAdditionalField()
    {
        return $this->hasOne(GeneralAdditionalFields::class, 'advertisement_id', 'id');
    }
}
